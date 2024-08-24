<?php

namespace App\Exports;

use App\Models\StudentAttendanceModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class ExportAttendance implements FromCollection, WithMapping, WithHeadings
{
    protected $classId;
    protected $attendanceDate;
    protected $attendanceType;
    protected $remark;

    public function __construct($classId, $attendanceDate, $attendanceType, $remark)
    {
        $this->classId = $classId;
        $this->attendanceDate = $attendanceDate;
        $this->attendanceType = $attendanceType;
        $this->remark = $remark;
    }

    public function headings(): array
    {
        return [
            "Student ID",
            "Student Name",
            "Class Name",
            "Attendance Type",
            "Attendance Date",
            "Remark"
        ];
    }

    public function map($value): array
    {
        $attendance_type = '';

        if ($value->attendance_type == 1) {
            $attendance_type = 'Present';
        } elseif ($value->attendance_type == 2) {
            $attendance_type = 'Late';
        } elseif ($value->attendance_type == 3) {
            $attendance_type = 'Absent';
        } elseif ($value->attendance_type == 4) {
            $attendance_type = 'Half Day';
        }

        return [
            $value->student_id,
            $value->student_name,
            $value->class_name,
            $attendance_type,
            date('d-m-Y', strtotime($value->attendance_date)),
            $value->remark
        ];
    }

    public function collection()
    {
        $request = new Request([
            'class_id' => $this->classId,
            'attendance_date' => $this->attendanceDate,
            'attendance_type' => $this->attendanceType,
            'remark' => $this->remark,
        ]);

        return StudentAttendanceModel::getRecord($request, true);
    }
}
