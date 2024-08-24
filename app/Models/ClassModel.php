<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'class'; // Ensure the table name matches your database

    // Fillable fields
    protected $fillable = ['name', 'standard', 'year', 'status', 'created_by'];

    // Get a single class record by its ID.
    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getTotalClass()
    {
        return self::where('status', 0)
            ->where('is_delete', 0)
            ->count();
    }

    // Get a paginated list of class records based on the provided request criteria.
    static public function getRecord(Request $request)
    {
        $query = ClassModel::select('class.*', 'users.name as created_by_name')
            ->join('users', 'users.id', 'class.created_by');

        // Filter by class name
        if (!empty($request->get('name'))) {
            $query->where('class.name', 'like', '%' . $request->get('name') . '%');
        }

        // Filter by standard
        if (!empty($request->get('standard'))) {
            $query->where('class.standard', '=', $request->get('standard'));
        }

        // Filter by year
        if (!empty($request->get('year'))) {
            $query->where('class.year', '=', $request->get('year'));
        }

        // Filter by status
        if (!empty($request->input('status'))) {
            $status = ($request->input('status') == 100) ? 0 : 1;
            $query->where('class.status', '=', $status);
        }

        // Filter by creation date
        if (!empty($request->get('date'))) {
            $query->whereDate('class.created_at', '=', $request->get('date'));
        }

        // Pagination and ordering
        $result = $query->where('class.is_delete', '=', 0)
            ->orderBy('class.id', 'desc')
            ->paginate(3);

        return $result;
    }

    // Get a list of active classes
    static public function getClass()
    {
        $return = ClassModel::select('class.id', 'class.name', 'class.standard', 'class.year')
            ->join('users', 'users.id', '=', 'class.created_by')
            ->where('class.is_delete', '=', 0)
            ->where('class.status', '=', 0)
            ->orderBy('class.name', 'asc')
            ->get();

        return $return;
    }

    static public function getClassByTeacher($teacher_id)
    {
        return self::select('class.id', 'class.name', 'class.standard', 'class.year')
            ->join('assign_homeroom_teacher', 'assign_homeroom_teacher.class_id', '=', 'class.id')
            ->where('assign_homeroom_teacher.teacher_id', '=', $teacher_id)
            ->where('class.is_delete', '=', 0)
            ->where('class.status', '=', 0)
            ->orderBy('class.name', 'asc')
            ->get();
    }


    static public function getClassAttendanceReport($teacher_id)
    {
        return ClassModel::select('class.id', 'class.name', 'class.standard', 'class.year')
            ->join('assign_homeroom_teacher', 'assign_homeroom_teacher.class_id', '=', 'class.id')
            ->where('assign_homeroom_teacher.teacher_id', '=', $teacher_id)
            ->where('class.is_delete', '=', 0)
            ->where('class.status', '=', 0)
            ->orderBy('class.name', 'asc')
            ->get();
    }
}
