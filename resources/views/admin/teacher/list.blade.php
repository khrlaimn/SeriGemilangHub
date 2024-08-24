@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6" style="text-align: right;">
                    <!-- Button to add a new admin -->
                    <a href="{{url('admin/teacher/add')}}" class="btn btn-primary"> Add New Teacher</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <!-- Search Student card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Search Teacher</h3>
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
                                    <!-- Email Field -->
                                    <div class="form-group  col-md-2">
                                        <label>Email</label>
                                        <input type="text" class="form-control" value="{{ Request::get('email') }}" name="email" placeholder="Email">
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
                                            <option {{ (Request::get('religion') == '0') ? 'selected' : '' }} value="0">Islam</option>
                                            <option {{ (Request::get('religion') == '1') ? 'selected' : '' }} value="1">Buddhist</option>
                                            <option {{ (Request::get('religion') == '2') ? 'selected' : '' }} value="2">Christians</option>
                                            <option {{ (Request::get('religion') == '3') ? 'selected' : '' }} value="3">Hindus</option>
                                        </select>
                                    </div>
                                    <!-- Mobile Number Field -->
                                    <div class="form-group  col-md-2">
                                        <label>Mobile Number</label>
                                        <input type="text" class="form-control" value="{{ Request::get('mobile_number') }}" name="mobile_number" placeholder="Mobile Number">
                                    </div>
                                    <!-- Date of Birth Field -->
                                    <div class="form-group  col-md-2">
                                        <label>Date of Birth</label>
                                        <input type="date" class="form-control" value="{{ Request::get('date_of_birth') }}" name="date_of_birth">
                                    </div>
                                    <!-- Status Field -->
                                    <div class="form-group col-md-2">
                                        <label>Status</label>
                                        <select class="form-control" name="status">
                                            <option value="">Select Status</option>
                                            <option {{ (Request::get('status') == 100) ? 'selected' : '' }} value="100">Active</option>
                                            <option {{ (Request::get('status') == 1) ? 'selected' : '' }} value="1">Inactive</option>
                                        </select>
                                    </div>
                                    <!-- Date Field -->
                                    <!-- <div class="form-group  col-md-2">
                                        <label>Created Date</label>
                                        <input type="date" class="form-control" value="{{ Request::get('created_at') }}" name="created_at">
                                    </div> -->

                                    <div class="form-group col-md-3">
                                        <!-- Search and Reset buttons -->
                                        <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                                        <a href="{{ url('admin/teacher/list') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- End of Search form -->
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

                    <!-- Admin List card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Teacher List</h3>
                        </div>
                        <!-- Admin List table -->
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Profile Picture </th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Date of Birth</th>
                                        <th>Religion</th>
                                        <th>Mobile Number</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $offset = ($getRecord->currentPage() - 1) * $getRecord->perPage();
                                    @endphp
                                    @foreach ($getRecord as $value)
                                    <tr>
                                        <!-- Student details -->
                                        <td>{{ $offset + $loop->iteration }}</td>
                                        <td>
                                            @if(!empty($value->getProfile()))
                                            <img src="{{ $value->getProfile() }}" style="height: 50px; width: 50px; border-radius: 50px;">
                                            @endif
                                        </td>
                                        <td>{{ $value->name }} {{ $value->last_name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->gender }}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->date_of_birth)) }}</td>
                                        <td>
                                            @php
                                            $religions = ['Islam', 'Buddhist', 'Christians', 'Hindus'];
                                            @endphp
                                            {{ $religions[$value->religion] ?? 'Unknown' }}
                                        </td>

                                        <td>{{ $value->mobile_number }}</td>
                                        <td>
                                            @if ($value->status == 0)
                                            <span class="badge badge-success">Active</span>
                                            @else
                                            <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <!-- Edit and Delete buttons -->
                                        <td style="min-width: 150px;">
                                            <a href="{{ url('admin/teacher/edit/' . $value->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <a href="{{ url('admin/teacher/delete/' . $value->id) }}" onclick="return confirm('Confirm DELETE?')" class="btn btn-danger btn-sm">Delete</a>
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
                </div>
            </div>
        </div>
    </section>
</div>
@endsection