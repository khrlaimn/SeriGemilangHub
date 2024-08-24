<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassModel;
use App\Models\NoticeBoardModel;
use App\Models\TeacherWhereaboutsModel;

class DashboardController extends Controller
{
    /**
     * Display the dashboard based on the user's type.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function dashboard()
    {
        $data = [];

        if (Auth::user()->user_type == 1) {
            $data['header_title'] = "Dashboard";
            $data['TotalAdmin'] = User::getTotalUser([1, 4, 5]);
            $data['TotalTeacher'] = User::getTotalUser(2);
            $data['TotalStudent'] = User::getTotalUser(3);
            $data['TotalClass'] = ClassModel::getTotalClass();
            return view('admin.dashboard', $data);
        } elseif (Auth::user()->user_type == 2) {
            $data['header_title'] = "Dashboard";
            $data['TotalStudent'] = User::getTeacherStudentCount(Auth::user()->id);
            $data['TotalNoticeBoard'] = NoticeBoardModel::getRecordUserCount(Auth::user()->user_type);
            return view('teacher.dashboard', $data);
        } elseif (Auth::user()->user_type == 3) {
            return view('student.dashboard', $data);
        } elseif (Auth::user()->user_type == 4) {
            $data['header_title'] = "Dashboard";
            $data['TotalWhereabouts'] = TeacherWhereaboutsModel::getTotalWhereabouts(1);
            $data['TotalTeacher'] = User::getTotalUser(2);
            $data['TotalStudent'] = User::getTotalUser(3);
            $data['TotalClass'] = ClassModel::getTotalClass();
            return view('headmaster.dashboard', $data);
        } elseif (Auth::user()->user_type == 5) {
            $data['header_title'] = "Dashboard";
            $data['TotalAdmin'] = User::getTotalUser(1);
            $data['TotalTeacher'] = User::getTotalUser(2);
            $data['TotalStudent'] = User::getTotalUser(3);
            $data['TotalClass'] = ClassModel::getTotalClass();
            return view('stad.dashboard', $data);
        }
    }
}
