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
                    <a href="{{url('teacher/whereabouts/add')}}" class="btn btn-primary"> Add New Whereabouts</a>
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
                            <h3 class="card-title">Search Teacher Whereabouts</h3>
                        </div>
                        <!-- Search form -->
                        <form method="get" action="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Remark</label>
                                        <input type="text" class="form-control" value="{{ Request::get('remark') }}" name="remark" placeholder="Remark">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Date</label>
                                        <input type="date" class="form-control" value="{{ Request::get('whereabouts_date') }}" name="whereabouts_date" placeholder="Date">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Status</label>
                                        <select class="form-control" name="status">
                                            <option value="">Select Status</option>
                                            <option {{ (Request::get('status') == 0) ? 'selected' : '' }} value="0">On Hold</option>
                                            <option {{ (Request::get('status') == 1) ? 'selected' : '' }} value="1">Accepted</option>
                                            <option {{ (Request::get('status') == 2) ? 'selected' : '' }} value="2">Rejected</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <!-- Search and Reset buttons -->
                                        <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                                        <a href="{{ url('teacher/whereabouts/list') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                                    </div>
                                </div>
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

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Whereabouts List</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Remark</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $count = 1;
                                    @endphp
                                    @foreach ($getRecord as $value)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $value->remark }}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->whereabouts_date)) }}</td>

                                        <td>
                                            @if ($value->status == 0)
                                            <span class="badge badge-info">On Hold</span>
                                            @elseif ($value->status == 1)
                                            <span class="badge badge-success">Accepted</span>
                                            @else
                                            <span class="badge badge-danger">Rejected</span>
                                            @endif
                                        </td>
                                        <!-- Edit and Delete buttons -->
                                        <!-- Edit and Withdraw buttons -->
                                        <td style="min-width: 150px;">
                                            <a href="{{ url('teacher/whereabouts/edit/' . $value->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <!-- Withdraw form -->
                                            <form method="POST" action="{{ route('teacher.whereabouts.delete', $value->id) }}" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Confirm WITHDRAW?')">Withdraw</button>
                                            </form>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination links -->
                            <div class="mt-3" style="float:right;">
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