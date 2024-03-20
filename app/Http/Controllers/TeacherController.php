<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    // Display list of teachers
    public function list(Request $request)
    {
        // Retrieve teacher records
        $data['getRecord'] = User::getTeacher($request);
        $data['header_title'] = "Teacher List";

        // Render the view with data
        return view('admin.teacher.list', $data);
    }

    // Display form to add a new teacher
    public function add()
    {
        $data['header_title'] = "Add New Teacher";

        // Render the view with data
        return view('admin.teacher.add', $data);
    }

    // Store a newly created teacher in storage
    public function insert(Request $request)
    {
        // Validate form data
        $request->validate([
            'profile_pic' => 'required|file|max:2048', // Maximum 2048 KiB (2MB)
            'email' => 'required|email|unique:users',
            'mobile_number' => 'max:15|min:10',
        ]);

        // Create new user instance
        $teacher = new User;

        // Set user data from form inputs
        $teacher->name = trim($request->name);
        $teacher->gender = trim($request->gender);
        $teacher->date_of_birth = trim($request->date_of_birth);
        $teacher->religion = trim($request->religion);
        $teacher->mobile_number = trim($request->mobile_number);

        // Upload profile picture
        $ext = $request->file('profile_pic')->getClientOriginalExtension();
        $randomStr = Str::random(20);
        $filename = strtolower($randomStr) . '.' . $ext;
        $request->file('profile_pic')->move(public_path('upload/profile/'), $filename);
        $teacher->profile_pic = $filename;

        // Set user status, email, password, and user type
        $teacher->status = trim($request->status);
        $teacher->email = trim($request->email);
        $teacher->password = Hash::make($request->password);
        $teacher->user_type = 2;

        // Save the teacher record
        $teacher->save();

        // Redirect with success message
        return redirect('admin/teacher/list')->with('success', 'Teacher Successfully Created');
    }

    // Show the form for editing the specified teacher
    public function edit($id)
    {
        // Retrieve teacher record by ID
        $data['getRecord'] = User::getSingle($id);

        // Check if record exists
        if (!empty($data['getRecord'])) {
            $data['header_title'] = "Edit Teacher";

            // Render the edit view with data
            return view('admin.teacher.edit', $data);
        } else {
            // If record not found, show 404 error
            abort(404);
        }
    }

    // Update the specified teacher in storage
    public function update($id, Request $request)
    {
        // Validate form data
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'profile_pic' => '|file|max:6048', // Maximum 2048 KiB (2MB)
            'mobile_number' => 'max:15|min:10',
        ]);

        // Retrieve teacher record by ID
        $teacher = User::getSingle($id);

        // Check if record exists
        if (!empty($teacher)) {
            // Set user data from form inputs
            $teacher->name = trim($request->name);
            $teacher->gender = trim($request->gender);
            $teacher->date_of_birth = trim($request->date_of_birth);
            $teacher->religion = trim($request->religion);
            $teacher->mobile_number = trim($request->mobile_number);

            // Upload and update profile picture if provided
            if (!empty($request->file('profile_pic'))) {
                if (!empty($teacher->getProfile())) {
                    unlink('upload/profile/' . $teacher->profile_pic);
                }
                $ext = $request->file('profile_pic')->getClientOriginalExtension();
                $randomStr = Str::random(20);
                $filename = strtolower($randomStr) . '.' . $ext;
                $request->file('profile_pic')->move(public_path('upload/profile/'), $filename);
                $teacher->profile_pic = $filename;
            }

            // Set user status, email
            $teacher->status = trim($request->status);
            $teacher->email = trim($request->email);

            // Update password if provided
            if (!empty($request->password)) {
                $teacher->password = Hash::make($request->password);
            }

            // Save the updated teacher record
            $teacher->save();

            // Redirect with success message
            return redirect('admin/teacher/list')->with('success', 'Teacher Successfully Updated');
        } else {
            // If record not found, show 404 error
            abort(404);
        }
    }

    // Remove the specified teacher from storage
    public function delete($id)
    {
        // Retrieve teacher record by ID
        $getRecord = User::getSingle($id);

        // Check if record exists
        if (!empty($getRecord)) {
            // Soft delete the teacher
            $getRecord->is_delete = 1;
            $getRecord->save();

            // Redirect with success message
            return redirect()->back()->with('success', 'Teacher Successfully Deleted');
        } else {
            // If record not found, show 404 error
            abort(404);
        }
    }
}
