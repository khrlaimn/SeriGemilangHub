@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- Title with total count of classes -->
                    <h1>Class List</h1>
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
                                    <div class="form-group col-md-3">
                                        <label>Name</label>
                                        <input type="text" class="form-control" value="{{ Request::get('name') }}" name="name" placeholder="Name">
                                    </div>
                                    <!-- Date Field -->
                                    <div class="form-group  col-md-3">
                                        <label>Date</label>
                                        <input type="date" class="form-control" value="{{ Request::get('date') }}" name="date" placeholder="Date">
                                    </div>
                                    <div class="form-group col-md-3">
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
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Created By</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($getRecord as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>
                                            @if ($value->status == 0)
                                            Active
                                            @else
                                            Inactive
                                            @endif
                                        </td>
                                        <td>{{ $value->created_by_name }}</td>
                                        <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
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