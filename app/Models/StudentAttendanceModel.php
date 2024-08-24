<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendanceModel extends Model
{
    use HasFactory;

    protected $table = 'student_attendance';

    protected $fillable = [
        'student_id',
        'class_id',
        'attendance_date',
        'attendance_type',
        'remark',
        'created_by'
    ];

    public static function getAttendanceSummary()
    {
        return self::selectRaw('attendance_type, COUNT(*) as count')
            ->groupBy('attendance_type')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item['attendance_type'] => $item['count']];
            });
    }

    public static function CheckAlreadyAttendance($student_id, $class_id, $attendance_date)
    {
        return self::where('student_id', '=', $student_id)
            ->where('class_id', '=', $class_id)
            ->where('attendance_date', '=', $attendance_date)
            ->first();
    }

    public static function getRecord($request = null, $remove_pagination = false)
    {
        $query = self::select('student_attendance.*', 'class.name as class_name', 'student.name as student_name', 'createdby.name as created_name')
            ->join('class', 'class.id', '=', 'student_attendance.class_id')
            ->join('users as student', 'student.id', '=', 'student_attendance.student_id')
            ->join('users as createdby', 'createdby.id', '=', 'student_attendance.created_by');

        if (!is_null($request) && $request instanceof \Illuminate\Http\Request) {
            if ($request->filled('student_name')) {
                $query->where('student.name', 'like', '%' . $request->input('student_name') . '%');
            }

            if ($request->filled('class_id')) {
                $query->where('student_attendance.class_id', $request->input('class_id'));
            }

            if ($request->filled('attendance_date')) {
                $query->whereDate('student_attendance.attendance_date', $request->input('attendance_date'));
            }

            if ($request->filled('attendance_type') && $request->input('attendance_type') !== 'all') {
                $query->where('student_attendance.attendance_type', $request->input('attendance_type'));
            }
        }

        return $remove_pagination ? $query->orderBy('student_attendance.id', 'desc')->get() : $query->orderBy('student_attendance.id', 'desc')->paginate(10);
    }

    public static function getRecordTeacher($class_ids)
    {
        if (!empty($class_ids)) {
            $query = self::select('student_attendance.*', 'class.name as class_name', 'class.standard', 'class.year', 'student.name as student_name', 'createdby.name as created_name')
                ->join('class', 'class.id', '=', 'student_attendance.class_id')
                ->join('users as student', 'student.id', '=', 'student_attendance.student_id')
                ->join('users as createdby', 'createdby.id', '=', 'student_attendance.created_by')
                ->whereIn('student_attendance.class_id', $class_ids);

            if (request()->filled('student_name')) {
                $query->where('student.name', 'like', '%' . request()->input('student_name') . '%');
            }

            if (request()->filled('class_id')) {
                $query->whereIn('student_attendance.class_id', (array)request()->input('class_id'));
            }

            if (request()->filled('attendance_date')) {
                $query->where('student_attendance.attendance_date', request()->input('attendance_date'));
            }

            if (request()->filled('attendance_type')) {
                $query->where('student_attendance.attendance_type', request()->input('attendance_type'));
            }

            return $query->orderBy('student_attendance.id', 'desc')->paginate(5);
        }

        return null;
    }
}
