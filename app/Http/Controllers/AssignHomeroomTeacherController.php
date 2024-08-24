<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\User;
use App\Models\AssignHomeroomTeacherModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class AssignHomeroomTeacherController extends Controller
{
    // Display list of assign class
    public function list(Request $request)
    {
        $data['getClass'] = ClassModel::where('is_delete', 0) // Exclude deleted classes
            ->where('status', 'active') // Assuming 'active' is the status you want to filter by
            ->get();
        $data['getRecord'] = AssignHomeroomTeacherModel::getRecord($request);
        $data['header_title'] = "Assign Homeroom Teacher";

        // Render the view with data
        return view('admin.assign_homeroom_teacher.list', $data);
    }

    // Display form to add a new Assign Class Teacher
    public function add()
    {
        // Retrieve class data for dropdown
        $data['getClass'] = ClassModel::getClass();

        // Fetch teachers with required conditions
        $data['getTeacher'] = User::getTeacherClass()
            ->where('is_delete', 0)
            ->where('status', 0)
            ->get();

        $data['header_title'] = "Add Assign Class Teacher";

        // Render the view with data
        return view('admin.assign_homeroom_teacher.add', $data);
    }

    // Store a newly created homeroom teacher in storage
    public function insert(Request $request)
    {
        // Validation rules
        $rules = [
            'class_id' => 'required',
            'teacher_id' => 'required',
            'status' => 'required',
        ];

        // Validate the request
        $request->validate($rules);

        // Check if the class already has a homeroom teacher assigned
        $existingAssignment = AssignHomeroomTeacherModel::where('class_id', $request->class_id)->first();

        if ($existingAssignment) {
            // If a homeroom teacher is already assigned, return error
            return redirect()->back()->with('error', 'This class already has a homeroom teacher assigned.');
        }

        // If no homeroom teacher is assigned, proceed with creating a new assignment
        $save = new AssignHomeroomTeacherModel;
        $save->class_id = $request->class_id;
        $save->teacher_id = $request->teacher_id;
        $save->status = $request->status;
        $save->created_by = Auth::user()->id;
        $save->save();

        return redirect('admin/assign_homeroom_teacher/list')->with('success', 'Successfully assigned Homeroom Teacher');
    }

    public function edit($id)
    {
        $getRecord = AssignHomeroomTeacherModel::getSingle($id);

        // Check if record exists
        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
            $data['getAssignTeacherID'] = AssignHomeroomTeacherModel::getAssignTeacherID($getRecord->class_id);
            $data['getClass'] = ClassModel::getClass();
            $data['getTeacher'] = User::getTeacherClassTwo(); // Ensure this is getting data correctly
            $data['header_title'] = "Edit Homeroom Teacher";
            // Render the edit view with data
            return view('admin.assign_homeroom_teacher.edit', $data);
        } else {
            // If record not found, show 404 error
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        // Validation rules
        $rules = [
            'class_id' => 'required',
            'teacher_id' => 'required',
            'status' => 'required',
        ];

        // Validate the request
        $request->validate($rules);

        // Check if the class already has a homeroom teacher assigned, excluding the current record being updated
        $existingAssignment = AssignHomeroomTeacherModel::where('class_id', $request->class_id)
            ->where('id', '!=', $id)
            ->first();

        if ($existingAssignment) {
            // If a homeroom teacher is already assigned to the class, return error
            return redirect()->back()->with('error', 'This class already has a homeroom teacher assigned.');
        }

        // If no homeroom teacher is assigned or it's the current record being updated, proceed with the update
        $homeroomTeacher = AssignHomeroomTeacherModel::findOrFail($id);
        $homeroomTeacher->class_id = $request->class_id;
        $homeroomTeacher->teacher_id = $request->teacher_id;
        $homeroomTeacher->status = $request->status;
        $homeroomTeacher->created_by = Auth::user()->id;
        $homeroomTeacher->save();

        return redirect('admin/assign_homeroom_teacher/list')->with('success', 'Successfully updated Homeroom Teacher');
    }

    // Remove the specified homeroom teacher from storage
    public function delete($id)
    {
        // Retrieve homeroom teacher record by ID
        $getRecord = AssignHomeroomTeacherModel::getSingle($id);

        // Check if record exists
        if (!empty($getRecord)) {
            // Soft delete the homeroom teacher
            $getRecord->is_delete = 1;
            $getRecord->save();

            // Redirect with success message
            return redirect()->back()->with('success', 'Homeroom Teacher Successfully Deleted');
        } else {
            // If record not found, show 404 error
            abort(404);
        }
    }
}
