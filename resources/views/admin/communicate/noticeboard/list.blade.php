@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Notice Board List</h1>
                </div>
                <div class="col-sm-6" style="text-align: right;">
                    <!-- Button to add a new admin -->
                    <a href="{{url('admin/communicate/notice_board/add')}}" class="btn btn-primary"> Add New Notice Board</a>
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
                            <h3 class="card-title">Search Notice Board</h3>
                        </div>
                        <!-- Search form -->
                        <form method="get" action="">
                            <div class="card-body">
                                <div class="row">
                                    <!-- Name Field -->
                                    <div class="form-group col-md-3">
                                        <label>Title</label>
                                        <input type="text" class="form-control" value="{{ Request::get('title') }}" name="title" placeholder="Title">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Publish Date</label>
                                        <input type="date" class="form-control" value="{{ Request::get('publish_date') }}" name="publish_date" placeholder="Title">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Message To</label>
                                        <select class="form-control" name="message_to">
                                            <option value="">Select</option>
                                            <option {{ (Request::get('message_to') == 'all') ? 'selected' : '' }} value="all">All</option>
                                            <option {{ (Request::get('message_to') == 1) ? 'selected' : '' }} value="1">Admin</option>
                                            <option {{ (Request::get('message_to') == 2) ? 'selected' : '' }} value="2">Teacher</option>
                                            <option {{ (Request::get('message_to') == 3) ? 'selected' : '' }} value="3">Public</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <!-- Search and Reset buttons -->
                                        <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                                        <a href="{{ url('admin/communicate/notice_board') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
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
                            <h3 class="card-title">Notice Board List</h3>
                        </div>
                        <!-- Admin List table -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">ID</th>
                                        <th>Title</th>
                                        <!-- <th>Notice Date</th> -->
                                        <th>Publish Date</th>
                                        <th>Message To</th>
                                        <th>Created By</th>
                                        <!-- <th>Created Date</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $offset = ($getRecord->currentPage() - 1) * $getRecord->perPage();
                                    @endphp
                                    @forelse ($getRecord as $value)
                                    <tr>
                                        <td>{{ $offset + $loop->iteration }}</td>
                                        <td>{{ $value->title}}</td>
                                        <!-- <td>{{ date('d-m-Y', strtotime($value->notice_date))}}</td> -->
                                        <td>{{ date('d-m-Y', strtotime($value->publish_date)) }}</td>
                                        <td>
                                            @foreach($value->getMessage as $message)
                                            @if($message->message_to == 1)
                                            <span class="badge badge-primary">Admin</span>
                                            @elseif($message->message_to == 2)
                                            <span class="badge badge-secondary">Teacher</span>
                                            @elseif($message->message_to == 3)
                                            <span class="badge badge-info">Public</span>
                                            @endif
                                            @endforeach
                                        </td>

                                        <td>{{ $value->created_by_name}}</td>
                                        <!-- <td>{{ date('d-m-Y', strtotime($value->created_at))}}</td> -->
                                        <td>
                                            <a href="{{ url('admin/communicate/notice_board/edit/' . $value->id) }}" class="btn btn-primary">Edit</a>
                                            <a href="{{ url('admin/communicate/notice_board/delete/' . $value->id) }}" onclick="return confirm('Confirm DELETE?')" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="100%">Record not found.</td>
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
                </div>
            </div>
        </div>
    </section>
</div>
@endsection