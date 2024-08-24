<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Get a single user by ID
    static public function getSingle($id)
    {
        return self::find($id);
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function getReligion()
    {
        $religions = ['Islam', 'Buddhist', 'Christians', 'Hindus'];

        return $religions[$this->religion] ?? 'Unknown';
    }

    static public function getTotalUser($user_types)
    {
        // Check if $user_types is an array, if not convert it to an array
        if (!is_array($user_types)) {
            $user_types = [$user_types];
        }

        $query = self::select('users.id')
            ->whereIn('user_type', $user_types)
            ->where('is_delete', '=', 0)
            ->where('status', '=', 0);

        return $query->count();
    }

    // Get admin users based on request parameters
    static public function getAdmin(Request $request)
    {
        $query = self::select('users.*')
            ->whereIn('user_type', [1, 4, 5])
            ->where('is_delete', 0);


        // Filter by name
        if (!empty($request->get('name'))) {
            $query->where('name', 'like', '%' . $request->get('name') . '%');
        }

        // Filter by email
        if (!empty($request->get('email'))) {
            $query->where('email', 'like', '%' . $request->get('email') . '%');
        }

        // Filter by creation date
        if (!empty($request->get('date'))) {
            $query->whereDate('created_at', '=', $request->get('date'));
        }

        return $query->orderBy('id', 'desc')->paginate(4);
    }

    static public function getTeacher(Request $request)
    {
        $query = self::select('users.*')
            ->where('users.user_type', '=', 2)
            ->where('users.is_delete', '=', 0);

        // Filter by name
        if (!empty($request->get('name'))) {
            $query->where('users.name', 'like', '%' . $request->get('name') . '%');
        }

        // Filter by email
        if (!empty($request->get('email'))) {
            $query->where('users.email', 'like', '%' . $request->get('email') . '%');
        }

        // Filter by gender
        if (!empty($request->get('gender'))) {
            $query->where('users.gender', '=', $request->get('gender'));
        }

        // Filter by religion
        if ($request->filled('religion')) {
            $query->where('users.religion', '=', $request->get('religion'));
        }

        // Filter by mobile number
        if (!empty($request->get('mobile_number'))) {
            $query->where('users.mobile_number', 'like', '%' . $request->get('mobile_number') . '%');
        }

        // Filter by status
        if (!empty($request->input('status'))) {
            $status = ($request->input('status') == 100) ? 0 : 1;
            $query->where('users.status', '=', $status);
        }

        // Filter by date of birth
        if (!empty($request->get('date_of_birth'))) {
            $query->whereDate('users.date_of_birth', 'like', $request->get('date_of_birth'));
        }

        // Filter by creation date
        if (!empty($request->get('created_at'))) {
            $query->whereDate('users.created_at', 'like', $request->get('created_at'));
        }

        return $query->orderBy('users.id', 'desc')->paginate(4);
    }

    // Get students based on request parameters
    static public function getTeacherStudent($teacher_id, Request $request)
    {
        $query = self::select('users.*', 'class.name as class_name')
            ->join('class', 'class.id', '=', 'users.class_id')
            ->join('assign_homeroom_teacher', 'assign_homeroom_teacher.class_id', '=', 'class.id')
            ->where('assign_homeroom_teacher.teacher_id', '=', $teacher_id)
            ->where('assign_homeroom_teacher.status', '=', 0)
            // ->where('users.status', '=', 0)
            ->where('assign_homeroom_teacher.is_delete', '=', 0)
            ->where('users.user_type', '=', 3)
            ->where('users.is_delete', '=', 0);

        // Filter by name
        if (!empty($request->get('name'))) {
            $query->where('users.name', 'like', '%' . $request->get('name') . '%');
        }

        // Filter by email
        if (!empty($request->get('email'))) {
            $query->where('users.email', 'like', '%' . $request->get('email') . '%');
        }

        // Filter by class ID
        if (!empty($request->get('class_id'))) {
            $query->where('users.class_id', '=', $request->get('class_id'));
        }

        // Filter by gender
        if (!empty($request->get('gender'))) {
            $query->where('users.gender', '=', $request->get('gender'));
        }

        // Filter by religion
        if ($request->filled('religion')) {
            $query->where('users.religion', '=', $request->get('religion'));
        }

        // Filter by mobile number
        if (!empty($request->get('mobile_number'))) {
            $query->where('users.mobile_number', 'like', '%' . $request->get('mobile_number') . '%');
        }

        // Filter by status
        if (!empty($request->input('status'))) {
            $status = ($request->input('status') == 100) ? 0 : 1;
            $query->where('users.status', '=', $status);
        }

        // Filter by date of birth
        if (!empty($request->get('date_of_birth'))) {
            $query->whereDate('users.date_of_birth', 'like', $request->get('date_of_birth'));
        }

        // Filter by creation date
        if (!empty($request->get('created_at'))) {
            $query->whereDate('users.created_at', 'like', $request->get('created_at'));
        }

        return $query->orderBy('users.id', 'desc')->paginate(4);
    }

    static public function getTeacherStudentCount($teacher_id)
    {
        $query = self::select('users.id')
            ->join('class', 'class.id', '=', 'users.class_id')
            ->join('assign_homeroom_teacher', 'assign_homeroom_teacher.class_id', '=', 'class.id')
            ->where('assign_homeroom_teacher.teacher_id', '=', $teacher_id)
            ->where('assign_homeroom_teacher.status', '=', 0)
            // ->where('users.status', '=', 0)
            ->where('assign_homeroom_teacher.is_delete', '=', 0)
            ->where('users.user_type', '=', 3)
            ->where('users.is_delete', '=', 0);

        return $query->count();
    }

    //For add new homeroom teacher
    static public function getTeacherClass()
    {
        $query = self::select('users.*')
            ->where('users.user_type', '=', 2)
            ->where('users.is_delete', '=', 0)
            ->where('users.status', '=', 0);

        return $query;
    }

    // static public function getTeacherClass()
    // {
    //     return self::where('user_type', '=', 2)
    //         ->where('is_delete', '=', 0)
    //         ->where('status', '=', 0)
    //         ->orderBy('name', 'asc')
    //         ->get();
    // }


    static public function getTeacherClassTwo()
    {
        return self::select('id', 'name')
            ->where('user_type', '=', 2)
            ->where('is_delete', '=', 0)
            ->where('status', '=', 0)
            ->orderBy('name', 'asc')
            ->get();
    }


    // Get students based on request parameters
    static public function getStudent(Request $request)
    {
        $query = self::select('users.*', 'class.name as class_name')
            ->leftJoin('class', 'class.id', '=', 'users.class_id') // Change 'left' to 'leftJoin'
            ->where('users.user_type', '=', 3)
            ->where('users.is_delete', '=', 0);

        // Filter by name
        if (!empty($request->get('name'))) {
            $query->where('users.name', 'like', '%' . $request->get('name') . '%');
        }

        // Filter by email
        if (!empty($request->get('email'))) {
            $query->where('users.email', 'like', '%' . $request->get('email') . '%');
        }

        // Filter by class ID
        if (!empty($request->get('class_id'))) {
            $query->where('users.class_id', '=', $request->get('class_id'));
        }

        // Filter by gender
        if (!empty($request->get('gender'))) {
            $query->where('users.gender', '=', $request->get('gender'));
        }

        // Filter by religion
        if ($request->filled('religion')) {
            $query->where('users.religion', '=', $request->get('religion'));
        }

        // Filter by mobile number
        if (!empty($request->get('mobile_number'))) {
            $query->where('users.mobile_number', 'like', '%' . $request->get('mobile_number') . '%');
        }

        // Filter by status
        if (!empty($request->input('status'))) {
            $status = ($request->input('status') == 100) ? 0 : 1;
            $query->where('users.status', '=', $status);
        }

        // Filter by date of birth
        if (!empty($request->get('date_of_birth'))) {
            $query->whereDate('users.date_of_birth', 'like', $request->get('date_of_birth'));
        }

        // Filter by creation date
        if (!empty($request->get('created_at'))) {
            $query->whereDate('users.created_at', 'like', $request->get('created_at'));
        }

        return $query->orderBy('users.id', 'desc')->paginate(4);
    }

    // Get students class based on request parameters
    static public function getStudentClass($class_id)
    {
        return self::select('users.id', 'users.name')
            ->where('users.user_type', '=', 3)
            ->where('users.is_delete', '=', 0)
            ->where('users.class_id', '=', $class_id)
            ->orderBy('users.id', 'desc')
            ->get();
    }

    static public function getAttendance($student_id, $class_id, $attendance_date)
    {
        return StudentAttendanceModel::CheckAlreadyAttendance($student_id, $class_id, $attendance_date);
    }

    // Get a single user by email
    static public function getEmailSingle($email)
    {
        return User::where('email', '=', $email)->first();
    }

    // Get a single user by remember token
    static public function getTokenSingle($remember_token)
    {
        return User::where('remember_token', '=', $remember_token)->first();
    }

    // Get user's profile picture URL
    public function getProfile()
    {
        if (!empty($this->profile_pic) && file_exists('upload/profile/' . $this->profile_pic)) {
            return url('upload/profile/' . $this->profile_pic);
        } else {
            return "";
        }
    }
}
