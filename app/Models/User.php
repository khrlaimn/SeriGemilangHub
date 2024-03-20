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

    // Get admin users based on request parameters
    static public function getAdmin(Request $request)
    {
        $query = self::select('users.*')
            ->where('user_type', '=', 1)
            ->where('is_delete', '=', 0);

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
        // if ($request->has('status')) {
        //     $status = ($request->get('status') == 100) ? 0 : 1;
        //     $query->where('users.status', '=',  $status);
        // }

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
    static public function getStudent(Request $request)
    {
        $query = self::select('users.*', 'class.name as class_name')
            ->join('class', 'class.id', '=', 'users.class_id', 'left')
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
        // if ($request->has('status')) {
        //     $status = ($request->get('status') == 100) ? 0 : 1;
        //     $query->where('users.status', '=',  $status);
        // }

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
