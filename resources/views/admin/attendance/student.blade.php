@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Student Attendance</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Search Student Attendance</h3>
                        </div>

                        <!-- Display Success Message -->
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        <!-- Search Form -->
                        <form method="get" action="{{ route('attendance.student') }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Class</label>
                                        <select class="form-control" name="class_id">
                                            <option value="">Select Class</option>
                                            @foreach($getClass as $value)
                                            <option value="{{ $value->id }}" {{ request()->input('class_id') == $value->id ? 'selected' : '' }}>
                                                Name: {{ $value->name }}, Grade: {{ $value->standard }}, Year: {{ $value->year }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div style="color:red">{{ $errors->first('class_id') }}</div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Attendance Date</label>
                                        <input type="date" class="form-control" id="getAttendanceDate" value="{{ request()->get('attendance_date') }}" name="attendance_date" required>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <button type="submit" class="btn btn-primary" style="margin-top: 30px;">Search</button>
                                        <a href="{{ route('attendance.student') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </form>


                        <!-- Attendance Form -->
                        @if (!empty($getStudent))
                        <form method="post" action="{{ route('attendance.student.save') }}">
                            @csrf
                            <div class="card-body p-0" style="overflow: auto;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Student Name</th>
                                            <th>Attendance</th>
                                            <th>Remark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getStudent as $student)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>
                                                <select name="attendance[{{ $student->id }}]" class="form-control">
                                                    <option value="1" {{ $attendanceRecords->has($student->id) && $attendanceRecords[$student->id]->attendance_type == 1 ? 'selected' : '' }}>Present</option>
                                                    <option value="2" {{ $attendanceRecords->has($student->id) && $attendanceRecords[$student->id]->attendance_type == 2 ? 'selected' : '' }}>Late</option>
                                                    <option value="3" {{ $attendanceRecords->has($student->id) && $attendanceRecords[$student->id]->attendance_type == 3 ? 'selected' : '' }}>Absent</option>
                                                    <option value="4" {{ $attendanceRecords->has($student->id) && $attendanceRecords[$student->id]->attendance_type == 4 ? 'selected' : '' }}>Half Day</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="remark[{{ $student->id }}]" class="form-control remark-input" value="{{ $attendanceRecords->has($student->id) ? $attendanceRecords[$student->id]->remark : '' }}">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-footer">
                                <input type="hidden" name="class_id" value="{{ request()->get('class_id') }}">
                                <input type="hidden" name="attendance_date" value="{{ request()->get('attendance_date') }}">
                                <button type="submit" class="btn btn-primary">Update Attendance</button>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection