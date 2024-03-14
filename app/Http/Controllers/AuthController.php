<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        // Check if the user is already authenticated
        if (!empty(Auth::check())) {
            // Redirect based on user type
            if (Auth::user()->user_type == 1) {
                return redirect('admin/dashboard');
            } elseif (Auth::user()->user_type == 2) {
                return redirect('teacher/dashboard');
            } elseif (Auth::user()->user_type == 3) {
                return redirect('student/dashboard');
            }
        }
        return view('auth.login');
    }

    public function AuthLogin(Request $request)
    {
        // Remember user if checkbox is checked
        $remember = !empty($request->remember) ? true : false;

        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            // Redirect based on user type
            if (Auth::user()->user_type == 1) {
                return redirect('admin/dashboard');
            } elseif (Auth::user()->user_type == 2) {
                return redirect('teacher/dashboard');
            } elseif (Auth::user()->user_type == 3) {
                return redirect('student/dashboard');
            }
        } else {
            // Authentication failed
            return redirect()->back()->with('error', 'Please enter correct email and password');
        }
    }

    public function forgotpassword()
    {
        return view('auth.forgot');
    }

    public function forgot_password_act(Request $request)
    {
        // Retrieve user by email
        $user = User::where('email', $request->email)->first();

        if (!empty($user)) {
            // Generate a new remember_token
            $user->remember_token = Str::random(30);
            $user->save();

            try {
                // Send the password reset email
                Mail::to($user->email)->send(new ForgotPasswordMail($user));

                return redirect()->back()->with('success', 'Please check your email to reset your password.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error sending email: ' . $e->getMessage());
            }
        } else {
            // User not found
            return redirect()->back()->with('error', 'Email not found in the system.');
        }
    }

    public function reset($remember_token)
    {
        // Retrieve user by remember_token
        $user = User::GetTokenSingle($remember_token);

        if (!empty($user)) {
            $data['user'] = $user;
            $data['token'] = $remember_token; // Add this line
            return view('auth.reset', $data);
        } else {
            // User not found
            abort(404);
        }
    }

    public function PostReset($token, Request $request)
    {
        // Retrieve user by remember_token
        $user = User::GetTokenSingle($token);

        if (!$user) {
            // Invalid token
            return redirect()->back()->with('error', 'Invalid token');
        }

        // Check if password and confirm password match
        if ($request->password == $request->cpassword) {
            // Update user password and generate a new remember_token
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();

            return redirect(url(''))->with('success', 'Password successfully reset');
        } else {
            // Passwords do not match
            return redirect()->back()->with('error', 'Password and confirm password do not match');
        }
    }

    public function logout()
    {
        // Logout the user and redirect to the home page
        Auth::logout();
        return redirect(url(''));
    }
}
