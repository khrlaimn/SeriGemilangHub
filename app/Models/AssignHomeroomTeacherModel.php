<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AssignHomeroomTeacherModel extends Model
{
    use HasFactory;

    protected $table = 'assign_homeroom_teacher';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    // Get a paginated list of class records based on the provided request criteria.
    static public function getRecord(Request $request)
    {
        // Pagination and ordering
        $query = self::select('assign_homeroom_teacher.*', 'class.name as class_name', 'teacher.name as teacher_name', 'users.name as created_by_name')
            ->join('users as teacher', 'teacher.id', '=', 'assign_homeroom_teacher.teacher_id')
            ->join('class', 'class.id', '=', 'assign_homeroom_teacher.class_id')
            ->join('users', 'users.id', '=', 'assign_homeroom_teacher.created_by')
            ->where('assign_homeroom_teacher.is_delete', '=', 0);

        if (!empty($request->input('class_id'))) {
            $query->where('class.id', '=', $request->input('class_id'));
        }

        if (!empty($request->input('teacher_name'))) {
            $query->where('teacher.name', 'like', '%' . $request->input('teacher_name') . '%');
        }
        if (!empty($request->input('status'))) {
            $status = ($request->input('status') == 100) ? 0 : 1;
            $query->where('assign_homeroom_teacher.status', '=', $status);
        }
        if (!empty($request->input('date'))) {
            $query->whereDate('assign_homeroom_teacher.created_at', '=', $request->input('date'));
        }


        $result = $query->orderBy('assign_homeroom_teacher.id', 'desc')
            ->paginate(3);

        return $result;
    }

    static public function getAlreadyFirst($class_id, $teacher_id)
    {
        return self::where('class_id', '=', $class_id)->where('teacher_id', '=', $teacher_id)->first();
    }

    static public function getAssignTeacherID($class_id)
    {
        return self::where('class_id', '=', $class_id)->where('is_delete', '=', 0)->get();
    }

    static public function deleteTeacher($class_id)
    {
        return self::where('class_id', '=', $class_id)->where('is_delete', '=', 0)->get();
    }

    static public function getMyStudentAttendance($teacher_id)
    {
        return AssignHomeroomTeacherModel::select(
            'assign_homeroom_teacher.class_id',
            'class.name as class_name',
            'class.id as class_id',
            'class.standard',   // Include standard
            'class.year'        // Include year
        )
            ->join('class', 'class.id', '=', 'assign_homeroom_teacher.class_id')
            ->where('assign_homeroom_teacher.is_delete', '=', 0)
            ->where('assign_homeroom_teacher.status', '=', 0)
            ->where('assign_homeroom_teacher.teacher_id', '=', $teacher_id)
            ->groupBy('assign_homeroom_teacher.class_id', 'class.name', 'class.id', 'class.standard', 'class.year')
            ->get();
    }
}
