<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    // Display user account details
    public function MyAccount()
    {
        // Retrieve user record by ID
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        $data['header_title'] = "My Account";

        // Check the user's type and return the corresponding my account view
        if (Auth::user()->user_type == 1) {
            return view('admin.my_account', $data);
        } elseif (Auth::user()->user_type == 2) {
            return view('teacher.my_account', $data);
        } elseif (Auth::user()->user_type == 4) {
            return view('headmaster.my_account', $data);
        } elseif (Auth::user()->user_type == 5) {
            return view('stad.my_account', $data);
        }
    }

    // Update account details for an admin
    public function UpdateMyAccountAdmin(Request $request)
    {
        // Get the ID of the authenticated user
        $id = Auth::user()->id;

        // Validate form data
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'profile_pic' => 'file|max:2048', // Maximum 2048 KiB (2MB)
            'mobile_number' => 'max:15|min:10',
        ]);

        // Retrieve admin record by ID
        $admin = User::getSingle($id);
        $admin->name = trim($request->name);
        $admin->email = trim($request->email);
        $admin->mobile_number = trim($request->mobile_number);

        // Upload and update profile picture if provided
        if ($request->hasFile('profile_pic')) {
            if (!empty($admin->profile_pic)) {
                // Ensure the old file exists before attempting to delete
                if (file_exists(public_path('upload/profile/' . $admin->profile_pic))) {
                    unlink(public_path('upload/profile/' . $admin->profile_pic)); // Delete old profile picture
                }
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext; // Generate random filename
            $request->file('profile_pic')->move(public_path('upload/profile/'), $filename); // Move uploaded file
            $admin->profile_pic = $filename; // Save filename in database
        }

        // Save the updated admin record
        $admin->save();

        // Redirect with success message
        return redirect()->back()->with('success', 'Account Successfully Updated');
    }

    // Update account details for a teacher
    public function UpdateMyAccount(Request $request)
    {
        // Get the ID of the authenticated user
        $id = Auth::user()->id;

        // Validate form data
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'profile_pic' => 'file|max:2048', // Maximum 2048 KiB (2MB)
            'mobile_number' => 'max:15|min:10',
        ]);

        // Retrieve user record by ID
        $user = User::getSingle($id);

        // Check if record exists
        if (!empty($user)) {
            // Set user data from form inputs
            $user->name = trim($request->name);
            $user->gender = trim($request->gender);
            $user->date_of_birth = trim($request->date_of_birth);
            $user->religion = trim($request->religion);
            $user->mobile_number = trim($request->mobile_number);

            // Upload and update profile picture if provided
            if ($request->hasFile('profile_pic')) {
                if (!empty($user->profile_pic)) {
                    // Ensure the old file exists before attempting to delete
                    if (file_exists(public_path('upload/profile/' . $user->profile_pic))) {
                        unlink(public_path('upload/profile/' . $user->profile_pic)); // Delete old profile picture
                    }
                }
                $ext = $request->file('profile_pic')->getClientOriginalExtension();
                $randomStr = Str::random(20);
                $filename = strtolower($randomStr) . '.' . $ext; // Generate random filename
                $request->file('profile_pic')->move(public_path('upload/profile/'), $filename); // Move uploaded file
                $user->profile_pic = $filename; // Save filename in database
            }

            // Set user email
            $user->email = trim($request->email);

            // Save the updated user record
            $user->save();

            // Redirect with success message
            return redirect()->back()->with('success', 'Account Successfully Updated');
        } else {
            // If record not found, show 404 error
            abort(404);
        }
    }

    // Show the form for changing password
    public function change_password()
    {
        $data['header_title'] = "Change Password";
        return view('profile.change_password', $data);
    }

    // Update the user's password
    public function update_change_password(Request $request)
    {
        $user = User::getSingle(Auth::user()->id);

        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->with('success', "Password successfully updated");
        } else {
            return redirect()->back()->with('error', "Old Password is not correct");
        }
    }
}
