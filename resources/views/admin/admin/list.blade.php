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
                    <!-- Button to add a new admin -->
                    <a href="{{url('admin/admin/add')}}" class="btn btn-primary"> Add New Admin</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <!-- Search Admin card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Search Admin</h3>
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
                                    <!-- Email Field -->
                                    <div class="form-group  col-md-3">
                                        <label>Email</label>
                                        <input type="text" class="form-control" value="{{ Request::get('email') }}" name="email" placeholder="Email">
                                    </div>
                                    <!-- Date Field -->
                                    <!-- <div class="form-group  col-md-3">
                                        <label>Date</label>
                                        <input type="date" class="form-control" value="{{ Request::get('date') }}" name="date" placeholder="Date">
                                    </div> -->
                                    <div class="form-group col-md-3">
                                        <!-- Search and Reset buttons -->
                                        <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                                        <a href="{{ url('admin/admin/list') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
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
                            <h3 class="card-title">Admin List</h3>
                        </div>
                        <!-- Admin List table -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Profile Picture </th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <!-- <th>Created Date</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $offset = ($getRecord->currentPage() - 1) * $getRecord->perPage();
                                    @endphp
                                    @foreach ($getRecord as $value)
                                    <tr>
                                        <!-- Admin details -->
                                        <td>{{ $offset + $loop->iteration }}</td>
                                        <td>
                                            @if(!empty($value->getProfile()))
                                            <img src="{{ $value->getProfile() }}" style="height: 50px; width: 50px; border-radius: 50px;">
                                            @endif
                                        </td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <!-- <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td> -->
                                        <!-- Edit and Delete buttons -->
                                        <td>
                                            <a href="{{ url('admin/admin/edit/' . $value->id) }}" class="btn btn-primary">Edit</a>
                                            <a href="{{ url('admin/admin/delete/' . $value->id) }}" onclick="return confirm('Confirm DELETE?')" class="btn btn-danger">Delete</a>
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