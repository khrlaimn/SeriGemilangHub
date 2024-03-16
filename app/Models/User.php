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

        if (!empty($request->get('name'))) {
            $query->where('name', 'like', '%' . $request->get('name') . '%');
        }

        if (!empty($request->get('email'))) {
            $query->where('email', 'like', '%' . $request->get('email') . '%');
        }

        if (!empty($request->get('date'))) {
            $query->whereDate('created_at', '=', $request->get('date'));
        }

        return $query->orderBy('id', 'desc')->paginate(4);
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
}
