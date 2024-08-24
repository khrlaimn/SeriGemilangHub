@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6" style="text-align: right;">
                    <!-- Button to add a new class -->
                    <a href="{{url('admin/class/add')}}" class="btn btn-primary"> Add New Class</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <!-- Search Class card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Search Class</h3>
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
                                    <!-- Standard Field -->
                                    <div class="form-group col-md-2">
                                        <label>Standard</label>
                                        <select class="form-control" name="standard">
                                            <option value="">Select Standard</option>
                                            @foreach($standards as $std)
                                            <option {{ (Request::get('standard') == $std) ? 'selected' : '' }}>{{ $std }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- Year Field -->
                                    <div class="form-group col-md-2">
                                        <label>Year</label>
                                        <input type="text" class="form-control" value="{{ Request::get('year') }}" name="year" placeholder="Year">
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
                                    <!-- <div class="form-group col-md-2">
                                        <label>Date</label>
                                        <input type="date" class="form-control" value="{{ Request::get('date') }}" name="date" placeholder="Date">
                                    </div> -->
                                    <div class="form-group col-md-2">
                                        <!-- Search and Reset buttons -->
                                        <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                                        <a href="{{ url('admin/class/list') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
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

                    <!-- Class List card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Class List</h3>
                        </div>
                        <!-- Class List table -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Standard</th>
                                        <th>Year</th>
                                        <th>Status</th>
                                        <!-- <th>Created By</th>
                                        <th>Created Date</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $offset = ($getRecord->currentPage() - 1) * $getRecord->perPage();
                                    @endphp
                                    @foreach ($getRecord as $value)
                                    <tr>
                                        <td>{{ $offset + $loop->iteration }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->standard }}</td>
                                        <td>{{ $value->year }}</td>
                                        <td>
                                            @if ($value->status == 0)
                                            <span class="badge badge-success">Active</span>
                                            @else
                                            <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <!-- <td>{{ $value->created_by_name }}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td> -->
                                        <td>
                                            <a href="{{ url('admin/class/edit/' . $value->id) }}" class="btn btn-primary">Edit</a>
                                            <a href="{{ url('admin/class/delete/' . $value->id) }}" onclick="return confirm('Confirm DELETE?')" class="btn btn-danger">Delete</a>
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