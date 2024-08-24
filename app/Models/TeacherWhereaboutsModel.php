<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TeacherWhereaboutsModel extends Model
{
    use HasFactory;

    protected $table = 'teacher_wherabouts';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    static public function getTotalWhereabouts()
    {
        return self::where('status', 0)
            ->where('is_delete', 0)
            ->count();
    }

    static public function getRecord(Request $request)
    {
        $query = TeacherWhereaboutsModel::select(
            'teacher_wherabouts.*',
            'created_by.name as created_by_name',
            'teachers.name as teacher_name'
        )
            ->join('users as created_by', 'created_by.id', '=', 'teacher_wherabouts.created_by')
            ->join('users as teachers', 'teachers.id', '=', 'teacher_wherabouts.created_by')
            ->where('teacher_wherabouts.is_delete', '=', 0); // corrected column name

        if ($request->filled('remark')) {
            $query->where('teacher_wherabouts.remark', 'like', '%' . $request->get('remark') . '%');
        }

        if ($request->filled('whereabouts_date')) {
            $query->whereDate('teacher_wherabouts.whereabouts_date', $request->input('whereabouts_date'));
        }

        if ($request->filled('status')) {
            $status = $request->input('status');
            $query->where('teacher_wherabouts.status', '=', $status);
        }

        $result = $query->orderBy('teacher_wherabouts.id', 'desc')->paginate(3);

        return $result;
    }


    static public function getTeacherWhereaboutsByUser(Request $request, $userId)
    {
        $query = self::select('teacher_wherabouts.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'teacher_wherabouts.created_by')
            ->where('teacher_wherabouts.is_delete', '=', 0)
            ->where('teacher_wherabouts.created_by', '=', $userId);

        if ($request->filled('remark')) {
            $query->where('teacher_wherabouts.remark', 'like', '%' . $request->get('remark') . '%');
        }

        if ($request->filled('whereabouts_date')) {
            $query->whereDate('teacher_wherabouts.whereabouts_date', $request->input('whereabouts_date'));
        }

        if ($request->filled('status')) {
            $status = $request->input('status');
            $query->where('teacher_wherabouts.status', '=', $status);
        }

        return $query->orderBy('teacher_wherabouts.id', 'desc')->paginate(3);
    }

    // Get user's proof picture URL
    public function getProof()
    {
        if (!empty($this->proof_pic) && file_exists(public_path('upload/proof/' . $this->proof_pic))) {
            return url('upload/proof/' . $this->proof_pic);
        } else {
            return ""; // Return an empty string if no proof picture is found
        }
    }
}
