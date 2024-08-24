@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6" style="text-align: right;">
                    <!-- Button to add a new student -->
                    <a href="{{ url('admin/student/add') }}" class="btn btn-primary">Add New Student</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <!-- Search Student -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Search Student</h3>
                        </div>
                        <!-- Search form -->
                        <form method="get" action="">
                            <div class="card-body">
                                <div class="row">
                                    <!-- Name Field -->
                                    <div class="form-group col-md-2">
                                        <label>Name</label>
                                        <input type="text" class="form-control" value="{{ Request::get('name') }}" name="name" placeholder="Name">
                                    </div>
                                    <!-- Class Field -->
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


                                    <!-- Gender Field -->
                                    <div class="form-group col-md-2">
                                        <label>Gender</label>
                                        <select class="form-control" name="gender">
                                            <option value="">Select Gender</option>
                                            <option {{ (Request::get('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                                            <option {{ (Request::get('gender') == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                                        </select>
                                    </div>
                                    <!-- Religion Field -->
                                    <div class="form-group col-md-2">
                                        <label>Religion</label>
                                        <select class="form-control" name="religion">
                                            <option value="">Select Religion</option>
                                            <option {{ (Request::get('religion') == 'Islam') ? 'selected' : '' }} value="Islam">Islam</option>
                                            <option {{ (Request::get('religion') == 'Buddhist') ? 'selected' : '' }} value="Buddhist">Buddhist</option>
                                            <option {{ (Request::get('religion') == 'Christians') ? 'selected' : '' }} value="Christians">Christians</option>
                                            <option {{ (Request::get('religion') == 'Hindus') ? 'selected' : '' }} value="Hindus">Hindus</option>
                                        </select>
                                    </div>
                                    <!-- Mobile Number Field -->
                                    <div class="form-group col-md-2">
                                        <label>Mobile Number</label>
                                        <input type="text" class="form-control" value="{{ Request::get('mobile_number') }}" name="mobile_number" placeholder="Mobile Number">
                                    </div>
                                    <!-- Date of Birth Field -->
                                    <div class="form-group col-md-2">
                                        <label>Date of Birth</label>
                                        <input type="date" class="form-control" name="date_of_birth" value="{{ Request::get('date_of_birth') }}" placeholder="Date of Birth">
                                    </div>


                                    <!-- Status Field -->
                                    <div class="form-group col-md-2">
                                        <label>Status</label>
                                        <select class="form-control" name="status">
                                            <option value="">Select Status</option>
                                            <option {{ (Request::get('status') == '0') ? 'selected' : '' }} value="0">Active</option>
                                            <option {{ (Request::get('status') == '1') ? 'selected' : '' }} value="1">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Search Button -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Search</button>
                                <a href="{{ url('admin/student/list') }}" class="btn btn-success">Reset</a>
                            </div>
                        </form>
                    </div>

                    <!-- Display success or error messages -->
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @elseif(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif

                    <!-- Display student records if available -->
                    @if($getRecord->isEmpty())
                    <div class="alert alert-info" role="alert">
                        No students found. Please use the search form above.
                    </div>
                    @else
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Student List</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Profile Pic</th>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>Gender</th>
                                        <th>Date of Birth</th>
                                        <th>Religion</th>
                                        <!-- <th>Mobile Number</th> -->
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $offset = ($getRecord->currentPage() - 1) * $getRecord->perPage();
                                    @endphp
                                    @foreach ($getRecord as $value)
                                    <tr>
                                        <td>{{ $offset + $loop->iteration }}</td>
                                        <td><img src="{{ asset('upload/profile/' . $value->profile_pic) }}" width="50" height="50" style="height: 50px; width: 50px; border-radius: 50px;"></td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->class_name }}</td>
                                        <td>{{ $value->gender }}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->date_of_birth)) }}</td>
                                        <td>
                                            @php
                                            $religions = ['Islam', 'Buddhist', 'Christians', 'Hindus'];
                                            @endphp
                                            {{ $religions[$value->religion] ?? 'Unknown' }}
                                        </td>
                                        <td>
                                            @if ($value->status == 0)
                                            <span class="badge badge-success">Active</span>
                                            @else
                                            <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td style="min-width: 150px;">
                                            <a href="{{ url('admin/student/edit/' . $value->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <a href="{{ url('admin/student/delete/' . $value->id) }}" onclick="return confirm('Confirm DELETE?')" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>


                            </table>

                            <!-- Pagination links -->
                            <div style="padding: 10px; float:right;">
                                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
</div>
@endsection