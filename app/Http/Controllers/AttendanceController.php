<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\User;
use App\Models\StudentAttendanceModel;
use App\Models\AssignHomeroomTeacherModel;
use Illuminate\Support\Facades\Auth;
use App\Exports\ExportAttendance;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    // Display list of assigned class and students
    public function AttendanceStudent(Request $request)
    {
        $data['getClass'] = ClassModel::where('is_delete', 0) // Exclude deleted classes
            ->where('status', 'active') // Assuming 'active' is the status you want to filter by
            ->get();
        $data['standards'] = ['1', '2', '3', '4', '5', '6'];


        $currentYear = Carbon::now()->year;
        $years = range($currentYear, $currentYear - 5); // Example: Last 5 years
        $data['years'] = array_combine($years, $years);

        if ($request->filled('class_id') && $request->filled('attendance_date')) {
            $class_id = $request->get('class_id');
            $attendance_date = $request->get('attendance_date');

            // Fetch students excluding deleted ones
            $data['getStudent'] = User::where('class_id', $class_id)
                ->where('is_delete', 0)
                ->where('status', 0)
                ->get();

            // Fetch attendance records
            $data['attendanceRecords'] = StudentAttendanceModel::where('class_id', $class_id)
                ->where('attendance_date', $attendance_date)
                ->get()
                ->keyBy('student_id');
        } else {
            $data['getStudent'] = [];
            $data['attendanceRecords'] = collect();
        }

        $data['header_title'] = "Student Attendance";
        return view('admin.attendance.student', $data);
    }


    // Handle attendance submission
    public function AttendanceStudentSubmit(Request $request)
    {
        $student_attendances = $request->input('attendance', []);
        $remarks = $request->input('remark', []);
        $class_id = $request->input('class_id');
        $attendance_date = $request->input('attendance_date');

        foreach ($student_attendances as $student_id => $attendance_type) {
            $attendance = StudentAttendanceModel::firstOrNew([
                'student_id' => $student_id,
                'class_id' => $class_id,
                'attendance_date' => $attendance_date
            ]);

            $attendance->attendance_type = $attendance_type;
            $attendance->remark = $remarks[$student_id] ?? '';
            $attendance->created_by = Auth::user()->id;
            $attendance->save();
        }

        return redirect()->route('attendance.student', ['class_id' => $class_id, 'attendance_date' => $attendance_date])
            ->with('success', 'Attendance updated successfully.');
    }

    public function AttendanceReport(Request $request)
    {
        $data['getClass'] = ClassModel::getClass($request);

        // Check if filters are provided
        $filtersProvided = $request->filled('student_name') || $request->filled('class_id') || $request->filled('attendance_date') || $request->filled('attendance_type');

        if ($filtersProvided) {
            $data['getRecord'] = StudentAttendanceModel::getRecord($request);
        } else {
            $data['getRecord'] = collect(); // Empty collection
        }

        $data['header_title'] = "Attendance Report";
        return view('admin.attendance.report', $data);
    }


    public function AttendanceReportExportExcel(Request $request)
    {
        $classId = $request->input('class_id');
        $attendanceDate = $request->input('attendance_date');
        $attendanceType = $request->input('attendance_type');
        $remark = ''; // Provide a default value for the $remark argument

        return Excel::download(new ExportAttendance($classId, $attendanceDate, $attendanceType, $remark), 'AttendanceReport_' . date('d-m-Y') . '.xls');
    }

    //STAD SIDE
    public function StadAttendanceReport(Request $request)
    {
        // Initialize $data as an array
        $data = [];

        // Get classes
        $data['getClass'] = ClassModel::getClass($request);

        // Check if filters are provided
        $filtersProvided = $request->filled('student_name') || $request->filled('class_id') || $request->filled('attendance_date') || $request->filled('attendance_type');

        if ($filtersProvided) {
            $data['getRecord'] = StudentAttendanceModel::getRecord($request);
        } else {
            $data['getRecord'] = collect(); // Empty collection
        }

        $data['header_title'] = "Attendance Report";

        return view('stad.attendance_report', $data);
    }

    public function StadAttendanceReportExportExcel(Request $request)
    {
        $classId = $request->input('class_id');
        $attendanceDate = $request->input('attendance_date');
        $attendanceType = $request->input('attendance_type');
        $remark = ''; // Provide a default value for the $remark argument

        return Excel::download(new ExportAttendance($classId, $attendanceDate, $attendanceType, $remark), 'AttendanceReport_' . date('d-m-Y') . '.xls');
    }


    //TEACHER SIDE
    public function AttendanceStudentTeacher(Request $request)
    {
        $data['getClass'] = AssignHomeroomTeacherModel::getMyStudentAttendance(Auth::user()->id);

        if (!empty($request->get('class_id')) && !empty($request->get('attendance_date'))) {
            $data['getStudent'] = User::getStudentClass($request->get('class_id'));

            // Fetch attendance records for the specified class and date
            $attendanceRecords = StudentAttendanceModel::where('class_id', $request->get('class_id'))
                ->whereDate('attendance_date', $request->get('attendance_date'))
                ->get()
                ->keyBy('student_id'); // keyBy to easily access by student ID

            // Pass attendance records to the view
            $data['attendanceRecords'] = $attendanceRecords;
        }

        $data['header_title'] = "Student Attendance";
        return view('teacher.attendance.student', $data);
    }

    public function TeacherAttendanceStudentSubmit(Request $request)
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $classId = $request->input('class_id');
        $attendanceDate = $request->input('attendance_date');
        $attendances = $request->input('attendance', []);
        $remarks = $request->input('remark', []);

        foreach ($attendances as $studentId => $attendanceType) {
            // Check if attendance record already exists
            $attendanceRecord = StudentAttendanceModel::CheckAlreadyAttendance($studentId, $classId, $attendanceDate);

            if ($attendanceRecord) {
                // Update existing record
                $attendanceRecord->update([
                    'attendance_type' => $attendanceType,
                    'remark' => $remarks[$studentId] ?? null,
                    'created_by' => Auth::user()->id
                ]);
            } else {
                // Create new record
                StudentAttendanceModel::create([
                    'student_id' => $studentId,
                    'class_id' => $classId,
                    'attendance_date' => $attendanceDate,
                    'attendance_type' => $attendanceType,
                    'remark' => $remarks[$studentId] ?? null,
                    'created_by' => Auth::user()->id
                ]);
            }
        }
        return redirect()->route('teacher.attendance.student', ['class_id' => $classId, 'attendance_date' => $attendanceDate])
            ->with('success', 'Attendance updated successfully.');
    }

    public function AttendanceReportTeacher(Request $request)
    {
        $teacher_id = Auth::user()->id; // Get the logged-in teacher's ID
        $getClass = ClassModel::getClassAttendanceReport($teacher_id); // Fetch classes for the logged-in teacher
        $classarray = array();
        foreach ($getClass as $value) {
            $classarray[] = $value->id; // Use the correct field to populate the array
        }

        $data['getClass'] = $getClass;
        $data['getRecord'] = StudentAttendanceModel::getRecordTeacher($classarray);
        $data['header_title'] = "Attendance Report";
        return view('teacher.attendance.report', $data);
    }

    // public function showAttendanceChart()
    // {
    //     // Fetch attendance summary data
    //     $attendanceSummary = ClassModel::getAttendanceSummary();

    //     // Prepare data for chart
    //     $chartData = [
    //         'labels' => $attendanceSummary->keys()->toArray(), // Class names
    //         'counts' => $attendanceSummary->values()->toArray(), // Attendance counts
    //     ];

    //     // Pass data to view
    //     return view('attendance.chart', compact('chartData'));
    // }
}
