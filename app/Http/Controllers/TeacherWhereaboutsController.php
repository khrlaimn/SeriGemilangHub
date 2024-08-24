<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TeacherWhereaboutsModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TeacherWhereaboutsController extends Controller
{

    //Admin Part
    public function list(Request $request)
    {
        $data['getRecord'] = TeacherWhereaboutsModel::getRecord($request);
        $data['header_title'] = "Whereabouts List";
        return view('admin.whereabouts.list', $data);
    }

    public function editByAdmin($id)
    {
        $data['getRecord'] = TeacherWhereaboutsModel::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = "Edit Whereabouts";
            return view('admin.whereabouts.edit', $data);
        } else {
            abort(404);
        }
    }

    public function updateByAdmin($id, Request $request)
    {
        $whereabouts = TeacherWhereaboutsModel::findOrFail($id);
        $whereabouts->status = $request->status;
        $whereabouts->save();

        return redirect('admin/whereabouts/list')->with('success', "Whereabouts successfully updated");
    }

    //Headmaster Part
    public function listHeadmaster(Request $request)
    {
        $data['getRecord'] = TeacherWhereaboutsModel::getRecord($request);
        $data['header_title'] = "Whereabouts List";
        return view('headmaster.whereabouts.list', $data);
    }

    public function editByHeadmaster($id)
    {
        $data['getRecord'] = TeacherWhereaboutsModel::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = "Edit Whereabouts";
            return view('headmaster.whereabouts.edit', $data);
        } else {
            abort(404);
        }
    }

    public function updateByHeadmaster($id, Request $request)
    {
        $whereabouts = TeacherWhereaboutsModel::findOrFail($id);
        $whereabouts->status = $request->status;
        $whereabouts->save();

        return redirect('headmaster/whereabouts/list')->with('success', "Whereabouts successfully updated");
    }


    //Teacher Part
    public function getTeacherWhereaboutsByUser(Request $request)
    {
        $userId = Auth::id();
        $data['getRecord'] = TeacherWhereaboutsModel::getTeacherWhereaboutsByUser($request, $userId);
        $data['header_title'] = "Whereabouts List";
        return view('teacher/whereabouts/list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Add New Whereabouts";
        $data['getTeacher'] = User::where('user_type', 2)->get();

        return view('teacher.whereabouts.add', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'proof_pic' => 'file|max:2048', // Remove the extra '|' before 'file'
        ]);

        $save = new TeacherWhereaboutsModel;
        $save->remark = $request->remark;
        $save->whereabouts_date = $request->whereabouts_date;

        // Check if a file was uploaded
        if ($request->hasFile('proof_pic')) {
            // Upload proof picture
            $file = $request->file('proof_pic');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/proof/'), $filename);
            $save->proof_pic = $filename;
        }

        $save->created_by = Auth::user()->id;
        $save->save();

        return redirect('teacher/whereabouts/list')->with('success', "Teacher whereabouts successfully created");
    }


    public function edit($id)
    {
        $data['getRecord'] = TeacherWhereaboutsModel::getSingle($id);
        $data['getTeacher'] = User::where('user_type', 2)->get(); // Assuming teachers have user_type of 2
        if (!empty($data['getRecord'])) {
            $data['header_title'] = "Edit Homeroom Teacher";
            return view('teacher.whereabouts.edit', $data);
        } else {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        // Validate form data
        $request->validate([
            'remark' => 'required',
            'whereabouts_date' => 'required|date',
            'proof_pic' => '|file|max:2048', // Maximum 2048 KiB (2MB)
        ]);

        // Retrieve the whereabouts record by ID
        $whereabouts = TeacherWhereaboutsModel::findOrFail($id);

        // Update the record with the provided data
        $whereabouts->remark = $request->remark;
        $whereabouts->whereabouts_date = $request->whereabouts_date;

        // Upload and update the proof picture if provided
        if (!empty($request->file('proof_pic'))) {
            if (!empty($whereabouts->getProof())) {
                unlink('upload/profile/' . $whereabouts->proof_pic);
            }
            $ext = $request->file('proof_pic')->getClientOriginalExtension();
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $request->file('proof_pic')->move(public_path('upload/proof/'), $filename);
            $whereabouts->proof_pic = $filename;
        }

        // Save the updated record
        $whereabouts->save();

        // Redirect with success message
        return redirect()->back()->with('success', 'Whereabouts successfully updated');
    }

    public function delete($id)
    {
        $getRecord = TeacherWhereaboutsModel::getSingle($id);

        // Check if record exists
        if (!empty($getRecord)) {
            // Soft delete the teacher
            $getRecord->is_delete = 1;
            $getRecord->save();

            // Redirect with success message
            return redirect()->back()->with('success', 'Whereabouts Successfully withdraw');
        } else {
            // If record not found, show 404 error
            abort(404);
        }
    }
}
