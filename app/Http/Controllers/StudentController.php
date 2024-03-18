<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\ClassModel;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    // Display list of students
    public function list(Request $request)
    {
        // Retrieve student records and class data
        $data['getRecord'] = User::getStudent($request);
        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = "Student List";

        // Render the view with data
        return view('admin.student.list', $data);
    }

    // Display form to add a new student
    public function add()
    {
        // Retrieve class data for dropdown
        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = "Add New Student";

        // Render the view with data
        return view('admin.student.add', $data);
    }

    // Store a newly created student in storage
    public function insert(Request $request)
    {
        // Validate form data
        $request->validate([
            'profile_pic' => 'required|file|max:2048', // Maximum 2048 KiB (2MB)
            'email' => 'required|email|unique:users',
            'mobile_number' => 'max:15|min:10',
            'admission_number' => 'max:50',
            'roll_number' => 'max:50',
        ]);

        // Create new user instance
        $student = new User;

        // Set user data from form inputs
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);
        $student->date_of_birth = trim($request->date_of_birth);
        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);

        // Upload profile picture
        $ext = $request->file('profile_pic')->getClientOriginalExtension();
        $randomStr = Str::random(20);
        $filename = strtolower($randomStr) . '.' . $ext;
        $request->file('profile_pic')->move(public_path('upload/profile/'), $filename);
        $student->profile_pic = $filename;

        // Set user status, email, password, and user type
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        $student->password = Hash::make($request->password);
        $student->user_type = 3;

        // Save the student record
        $student->save();

        // Redirect with success message
        return redirect('admin/student/list')->with('success', 'Student Successfully Created');
    }

    // Show the form for editing the specified student
    public function edit($id)
    {
        // Retrieve student record by ID
        $data['getRecord'] = User::getSingle($id);

        // Check if record exists
        if (!empty($data['getRecord'])) {
            // Retrieve class data for dropdown
            $data['getClass'] = ClassModel::getClass();
            $data['header_title'] = "Edit Student";

            // Render the edit view with data
            return view('admin.student.edit', $data);
        } else {
            // If record not found, show 404 error
            abort(404);
        }
    }

    // Update the specified student in storage
    public function update($id, Request $request)
    {
        // Validate form data
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'profile_pic' => '|file|max:2048', // Maximum 2048 KiB (2MB) remove required
            'mobile_number' => 'max:15|min:10',
            'admission_number' => 'max:50',
            'roll_number' => 'max:50',
        ]);

        // Retrieve student record by ID
        $student = User::getSingle($id);

        // Check if record exists
        if (!empty($student)) {
            // Set user data from form inputs
            $student->name = trim($request->name);
            $student->last_name = trim($request->last_name);
            $student->admission_number = trim($request->admission_number);
            $student->roll_number = trim($request->roll_number);
            $student->class_id = trim($request->class_id);
            $student->gender = trim($request->gender);
            $student->date_of_birth = trim($request->date_of_birth);
            $student->religion = trim($request->religion);
            $student->mobile_number = trim($request->mobile_number);

            // Upload and update profile picture if provided
            if (!empty($request->file('profile_pic'))) {
                if (!empty($student->getProfile())) {
                    unlink('upload/profile/' . $student->profile_pic);
                }
                $ext = $request->file('profile_pic')->getClientOriginalExtension();
                $randomStr = Str::random(20);
                $filename = strtolower($randomStr) . '.' . $ext;
                $request->file('profile_pic')->move(public_path('upload/profile/'), $filename);
                $student->profile_pic = $filename;
            }

            // Set user status and email
            $student->status = trim($request->status);
            $student->email = trim($request->email);

            // Update password if provided
            if (!empty($request->password)) {
                $student->password = Hash::make($request->password);
            }

            // Save the updated student record
            $student->save();

            // Redirect with success message
            return redirect('admin/student/list')->with('success', 'Student Successfully Updated');
        } else {
            // If record not found, show 404 error
            abort(404);
        }
    }

    // Remove the specified student from storage
    public function delete($id)
    {
        // Retrieve student record by ID
        $getRecord = User::getSingle($id);

        // Check if record exists
        if (!empty($getRecord)) {
            // Soft delete the student
            $getRecord->is_delete = 1;
            $getRecord->save();

            // Redirect with success message
            return redirect()->back()->with('success', 'Student Successfully Deleted');
        } else {
            // If record not found, show 404 error
            abort(404);
        }
    }
}
