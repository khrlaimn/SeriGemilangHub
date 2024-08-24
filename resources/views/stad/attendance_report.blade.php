@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
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
                        <form method="get" action="">
                            <div class="card-body">
                                <div class="row">

                                    <div class="form-group col-md-3">
                                        <label>Student Name</label>
                                        <input type="text" class="form-control" placeholder="Student Name" value="{{Request::get('student_name')}}" name="student_name">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Class</label>
                                        <select class="form-control" name="class_id">
                                            <option value="">Select Class</option>
                                            @foreach($getClass as $value)
                                            <option value="{{ $value->id }}" {{ (Request::get('class_id') == $value->id) ? 'selected' : '' }}>
                                                Name: {{ $value->name }}, Grade: {{ $value->standard }}, Year: {{ $value->year }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div style="color:red">{{ $errors->first('class_id') }}</div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Attendance Date</label>
                                        <input type="date" class="form-control" value="{{ Request::get('attendance_date') }}" name="attendance_date" placeholder="Date">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Attendance Type</label>
                                        <select class="form-control" name="attendance_type">
                                            <option value="" disabled>Select Attendance Type</option>
                                            <option value="all" {{ (Request::get('attendance_type') == 'all') ? 'selected' : '' }}>All</option>
                                            <option value="1" {{ (Request::get('attendance_type') == '1') ? 'selected' : '' }}>Present</option>
                                            <option value="2" {{ (Request::get('attendance_type') == '2') ? 'selected' : '' }}>Late</option>
                                            <option value="3" {{ (Request::get('attendance_type') == '3') ? 'selected' : '' }}>Absent</option>
                                            <option value="4" {{ (Request::get('attendance_type') == '4') ? 'selected' : '' }}>Half Day</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <button type="submit" class="btn btn-primary" style="margin-top: 30px;">Search</button>
                                        <!-- Submit button -->
                                        <a href="{{ url('stad/attendance_report') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                                        <!-- Reset button -->
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- End Form -->
                    </div>

                    @if($getRecord->isNotEmpty())
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Attendance List</h3>

                            <form style="float: right;" action="{{ route('attendance.report_export_excel') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="student_id" value="{{ Request::get('student_id') }}">
                                <input type="hidden" name="student_name" value="{{ Request::get('student_name') }}">
                                <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                                <input type="hidden" name="attendance_type" value="{{ Request::get('attendance_type') }}">
                                <input type="hidden" name="attendance_date" value="{{ Request::get('attendance_date') }}">
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
                                        <th>Remark</th>
                                        <th>Attendance Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $offset = ($getRecord->currentPage() - 1) * $getRecord->perPage();
                                    @endphp
                                    @forelse ($getRecord as $value)
                                    <tr>
                                        <td>{{ $offset + $loop->iteration }}</td>
                                        <td>{{ $value->student_name}}</td>
                                        <td>{{ $value->class_name}}</td>
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
                                        <td>{{ $value->remark}}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->attendance_date)) }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6">No students found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- Pagination links -->
                            <div style="padding: 10px; float:right;">
                                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-info" role="alert">
                        No students found. Please use the search form above.
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
<script>
    flatpickr('#getAttendanceDate', {
        dateFormat: 'd-m-Y', // Set the date format
    });
</script>
@endsection