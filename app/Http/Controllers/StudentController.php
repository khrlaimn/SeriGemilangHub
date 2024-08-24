<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\ClassModel;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    // Display list of students
    public function list(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = "Student List";

        if ($request->hasAny(['name', 'class_id', 'gender', 'religion', 'mobile_number', 'date_of_birth', 'status'])) {
            $query = User::query()
                ->leftJoin('class', 'class.id', '=', 'users.class_id')
                ->where('users.user_type', '=', 3)
                ->where('users.is_delete', '=', 0);

            if ($request->filled('name')) {
                $query->where('users.name', 'like', '%' . $request->input('name') . '%');
            }
            if ($request->filled('class_id')) {
                $query->where('users.class_id', $request->input('class_id'));
            }
            if ($request->filled('gender')) {
                $query->where('users.gender', $request->input('gender'));
            }
            if ($request->filled('religion')) {
                $query->where('users.religion', $request->input('religion'));
            }
            if ($request->filled('mobile_number')) {
                $query->where('users.mobile_number', 'like', '%' . $request->input('mobile_number') . '%');
            }
            if ($request->filled('date_of_birth')) {
                $dateOfBirth = date('Y-m-d', strtotime($request->input('date_of_birth')));
                $query->whereDate('users.date_of_birth', '=', $dateOfBirth);
            }
            if ($request->filled('status')) {
                $query->where('users.status', $request->input('status'));
            }

            $query->select('users.*', 'class.name as class_name');
            $data['getRecord'] = $query->paginate(10);
        } else {
            $data['getRecord'] = collect();
        }

        return view('admin.student.list', $data);
    }

    // Display form to add a new student
    public function add()
    {
        // Retrieve class data for dropdown
        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = "Add New Student";

        // Render the view with dataå
        return view('admin.student.add', $data);
    }

    // Store a newly created student in storage
    public function insert(Request $request)
    {
        // Validate form data
        $request->validate([
            'profile_pic' => 'required|file|max:2048',
            'mobile_number' => 'required|numeric|digits_between:9,15',
        ]);

        // Create new user instance
        $student = new User;

        // Set user data from form inputs
        $student->name = trim($request->name);
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

        // Set user status and user type
        $student->status = trim($request->status);
        $student->user_type = 3; // Assuming 3 is the student user type

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
            'profile_pic' => '|file|max:2048', // Maximum 2048 KiB (2MB) remove required
            'mobile_number' => 'max:15|min:10',
        ]);

        // Retrieve student record by ID
        $student = User::getSingle($id);

        // Check if record exists
        if (!empty($student)) {
            // Set user data from form inputs
            $student->name = trim($request->name);
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

            // Set user status
            $student->status = trim($request->status);

            // Save the updated student record
            $student->save();

            // Redirect with success message
            return redirect()->back()->with('success', 'Student Successfully Updated');
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

    // Teacher side work
    public function MyStudent(Request $request)
    {
        $teacher_id = Auth::user()->id;
        $data['getRecord'] = User::getTeacherStudent($teacher_id, $request);
        $data['getClass'] = ClassModel::getClassByTeacher($teacher_id);
        $data['header_title'] = "My Student List";

        return view('teacher.my_student', $data);
    }
    public function MyStudentDetails($id)
    {
        // Fetch the user record with the 'class' relationship eager loaded
        $getRecord = User::with('class')->find($id);

        // Check if record exists
        if (!empty($getRecord)) {
            // Retrieve class data for dropdown
            $getClass = ClassModel::getClass();
            $header_title = "Student Details";
            // Render the edit view with data
            return view('teacher.my_student_details', compact('getRecord', 'getClass', 'header_title'));
        } else {
            // If record not found, show 404 error
            abort(404);
        }
    }
}
