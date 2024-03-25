<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\User;
use App\Models\AssignHomeroomTeacherModel;
use Illuminate\Support\Facades\Auth;


class AssignHomeroomTeacherController extends Controller
{
    // Display list of assign class
    public function list(Request $request)
    {
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
        $data['getTeacher'] = User::getTeacherClass();

        $data['header_title'] = "Add Assign Class Teacher";

        // Render the view with data
        return view('admin.assign_homeroom_teacher.add', $data);
    }

    // Store a newly created homeroom teacher in storage
    public function insert(Request $request)
    {
        if (empty($request->teacher_id)) {
            return redirect()->back()->with('error', 'Please select a teacher to assign.');
        }

        // Check for an existing assignment without considering the status.
        $getAlreadyFirst = AssignHomeroomTeacherModel::where('class_id', $request->class_id)
            ->where('teacher_id', $request->teacher_id)
            ->first();

        if ($getAlreadyFirst) {
            // If any assignment exists, inform the admin regardless of the status.
            return redirect()->back()->with('error', 'This teacher is already assigned to this class.');
        }

        // If no previous assignment exists, create a new one.
        $save = new AssignHomeroomTeacherModel;
        $save->class_id = $request->class_id;
        $save->teacher_id = $request->teacher_id;
        $save->status = $request->status;
        $save->created_by = Auth::user()->id; // Ensure this ID exists and is correct.
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
            $data['getTeacher'] = User::getTeacherClass();
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
        if (empty($request->teacher_id)) {
            return redirect()->back()->with('error', 'Please select a teacher to assign.');
        }

        // Check if the teacher is already assigned to the class, excluding the current record being updated.
        $existingAssignment = AssignHomeroomTeacherModel::where('class_id', $request->class_id)
            ->where('teacher_id', $request->teacher_id)
            ->where('id', '!=', $id) // Exclude the current record being updated
            ->first();

        if ($existingAssignment) {
            // If an assignment exists for a different record, inform the admin.
            return redirect()->back()->with('error', 'This teacher is already assigned to this class.');
        }

        // If no previous assignment exists or it's the current record being updated, proceed with the update.
        $homeroomTeacher = AssignHomeroomTeacherModel::findOrFail($id);
        $homeroomTeacher->class_id = $request->class_id;
        $homeroomTeacher->teacher_id = $request->teacher_id;
        $homeroomTeacher->status = $request->status;
        $homeroomTeacher->created_by = Auth::user()->id; // Ensure this ID exists and is correct.
        $homeroomTeacher->save();

        return redirect('admin/assign_homeroom_teacher/list')->with('success', 'Successfully Update Homeroom Teacher');
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
