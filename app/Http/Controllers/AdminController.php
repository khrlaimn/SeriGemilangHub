<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // Display a listing of the admin users
    public function list(Request $request)
    {
        $data['getRecord'] = User::getAdmin($request);
        $data['header_title'] = "Admin List";
        return view('admin.admin.list', $data);
    }

    // Show the form for creating a new admin user
    public function add()
    {
        $data['header_title'] = "Add New Admin";
        return view('admin.admin.add', $data);
    }

    // Store a newly created admin user in storage
    public function insert(Request $request)
    {
        // Validate form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_type' => 'required|in:1,4,5',
        ]);

        // Create a new User instance
        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->user_type = $request->user_type; // Assign user type from the form

        // Upload profile picture
        $profilePic = $request->file('profile_pic');
        $filename = $profilePic->getClientOriginalName(); // or use Str::random(20) for a random filename
        $profilePic->move(public_path('upload/profile/'), $filename);
        $user->profile_pic = $filename;

        // Save the user
        $user->save();

        // Redirect with success message
        return redirect('admin/admin/list')->with('success', "Admin successfully created");
    }


    // Show the form for editing the specified admin user
    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = "Edit Admin";
            return view('admin.admin.edit', $data);
        } else {
            abort(404);
        }
    }

    // Update the specified admin user in storage
    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'user_type' => 'required|in:1,4,5',
        ]);

        $user = User::getSingle($id);
        $user->name = trim($request->name);

        // Upload and update profile picture if provided
        if (!empty($request->file('profile_pic'))) {
            if (!empty($user->getProfile())) {
                unlink('upload/profile/' . $user->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $request->file('profile_pic')->move(public_path('upload/profile/'), $filename);
            $user->profile_pic = $filename;
        }

        $user->email = trim($request->email);
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->user_type = $request->user_type;

        $user->save();

        return redirect()->back()->with('success', "Admin successfully updated");
    }

    // Remove the specified admin user from storage
    public function delete($id)
    {
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('admin/admin/list')->with('success', "Admin successfully deleted");
    }
}
