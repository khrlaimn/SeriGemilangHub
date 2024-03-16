<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClassModel;

class ClassController extends Controller
{
    // Display a listing of classes
    public function list(Request $request)
    {
        $data['getRecord'] = ClassModel::getRecord($request);

        $data['header_title'] = "Class List";
        return view('admin.class.list', $data);
    }

    // Show the form for adding a new class
    public function add()
    {
        $data['header_title'] = "Add New Class";
        return view('admin.class.add', $data);
    }

    // Store a newly created class in storage
    public function insert(Request $request)
    {
        $save = new ClassModel;
        $save->name = $request->name;
        $save->status = $request->status;
        $save->created_by = Auth::user()->id;
        $save->save();

        return redirect('admin/class/list')->with('success', "Class successfully created");
    }

    // Show the form for editing the specified class
    public function edit($id)
    {
        $data['getRecord'] = ClassModel::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = "Edit Class";
            return view('admin.class.edit', $data);
        } else {
            abort(404);
        }
    }

    // Update the specified class in storage
    public function update($id, Request $request)
    {
        $save = ClassModel::getSingle($id);
        $save->name = $request->name;
        $save->status = $request->status;
        $save->save();

        return redirect('admin/class/list')->with('success', "Class successfully updated");
    }

    // Remove the specified class from storage
    public function delete($id)
    {
        $save = ClassModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();

        return redirect()->back()->with('success', "Class successfully deleted");
    }
}
