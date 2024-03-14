<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard based on the user's type.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function dashboard()
    {
        // Set the header title for the view
        $data['header_title'] = 'Dashboard';

        // Check the user's type and return the corresponding dashboard view
        if (Auth::user()->user_type == 1) {
            return view('admin.dashboard', $data);
        } elseif (Auth::user()->user_type == 2) {
            return view('teacher.dashboard', $data);
        } elseif (Auth::user()->user_type == 3) {
            return view('student.dashboard', $data);
        }
    }
}
