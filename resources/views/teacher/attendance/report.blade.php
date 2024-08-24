@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Student Attendance Report</h1>
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
                            <h3 class="card-title">Search Attendance</h3>
                        </div>

                        <!-- Form -->
                        <form method="get" action="{{ route('teacher.attendance.report') }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Student Name</label>
                                        <input type="text" class="form-control" placeholder="Student Name" value="{{ request()->input('student_name') }}" name="student_name">
                                    </div>

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
                                        <input type="date" class="form-control" value="{{ request()->input('attendance_date') }}" name="attendance_date" placeholder="Date">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Attendance Type</label>
                                        <select class="form-control" name="attendance_type">
                                            <option value="" disabled selected>Select Attendance Type</option>
                                            <option {{ request()->input('attendance_type') == 1 ? 'selected' : '' }} value="1">Present</option>
                                            <option {{ request()->input('attendance_type') == 2 ? 'selected' : '' }} value="2">Late</option>
                                            <option {{ request()->input('attendance_type') == 3 ? 'selected' : '' }} value="3">Absent</option>
                                            <option {{ request()->input('attendance_type') == 4 ? 'selected' : '' }} value="4">Half Day</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <button type="submit" class="btn btn-primary" style="margin-top: 30px;">Search</button>
                                        <a href="{{ route('teacher.attendance.report') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- End Form -->
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Attendance List</h3>

                            <form style="float: right;" action="{{ url('teacher/attendance/report_export_excel') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="student_name" value="{{ request()->input('student_name') }}">
                                <input type="hidden" name="class_id" value="{{ request()->input('class_id') }}">
                                <input type="hidden" name="attendance_type" value="{{ request()->input('attendance_type') }}">
                                <input type="hidden" name="attendance_date" value="{{ request()->input('attendance_date') }}">

                                <button class="btn btn-primary">Export Excel</button>

                            </form>
                        </div>

                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Student Name</th>
                                        <th>Class Name</th>
                                        <th>Attendance Type</th>
                                        <th>Attendance Date</th>
                                        <th>Remark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $offset = ($getRecord->currentPage() - 1) * $getRecord->perPage();
                                    @endphp
                                    @forelse ($getRecord as $value)
                                    <tr>
                                        <td>{{ $offset + $loop->iteration }}</td>
                                        <td>{{ $value->student_name }}</td>
                                        <td>{{ $value->class_name }}</td>
                                        <td>
                                            @if($value->attendance_type == 1)
                                            <span class="badge badge-success">Present</span>
                                            @elseif($value->attendance_type == 2)
                                            <span class="badge badge-warning">Late</span>
                                            @elseif($value->attendance_type == 3)
                                            <span class="badge badge-danger">Absent</span>
                                            @elseif($value->attendance_type == 4)
                                            <span class="badge badge-info">Half Day</span>
                                            @endif
                                        </td>
                                        <td>{{ date('d-m-Y', strtotime($value->attendance_date)) }}</td>
                                        <td>{{ $value->remark }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="100%">No students found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            @if($getRecord instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            <!-- Pagination links -->
                            <div style="padding: 10px; float:right;">
                                {!! $getRecord->appends(request()->except('page'))->links() !!}
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
@endsection