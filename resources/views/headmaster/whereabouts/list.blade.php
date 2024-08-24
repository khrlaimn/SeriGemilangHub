@extends('layouts.app')

@section('content')

<div class="content-wrapper">

    <!-- Main content -->
    <section class="content-header">
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
                                    <!-- <div class="form-group col-md-3">
                                        <label>Remark</label>
                                        <input type="text" class="form-control" value="{{ Request::get('remark') }}" name="remark" placeholder="Remark">
                                    </div> -->
                                    <div class="form-group col-md-3">
                                        <label>Date</label>
                                        <input type="date" class="form-control" value="{{ Request::get('whereabouts_date') }}" name="whereabouts_date" placeholder="Date">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Status</label>
                                        <select class="form-control" name="status">
                                            <option value="">Select Status</option>
                                            <option {{ (Request::get('status') == 0) ? 'selected' : '' }} value="0">Dalam Proses</option>
                                            <option {{ (Request::get('status') == 1) ? 'selected' : '' }} value="1">Accepted</option>
                                            <option {{ (Request::get('status') == 2) ? 'selected' : '' }} value="2">Rejected</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <!-- Search and Reset buttons -->
                                        <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                                        <a href="{{ url('headmaster/whereabouts/list') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
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
                                        <th>Teacher Name</th>
                                        <th>Remark</th>
                                        <th>Date</th>
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
                                        <td>{{ $offset + $loop->iteration }}</td>
                                        <td>{{ $value->teacher_name }}</td>
                                        <td>{{ $value->remark }}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->whereabouts_date)) }}</td>
                                        <td>
                                            @if ($value->status == 0)
                                            <span class="badge badge-info">In Process</span>
                                            @elseif ($value->status == 1)
                                            <span class="badge badge-success">Accepted</span>
                                            @elseif ($value->status == 2)
                                            <span class="badge badge-danger">Rejected</span>
                                            @endif
                                        </td>

                                        <!-- Edit and Delete buttons -->
                                        <td style="min-width: 150px;">
                                            <a href="{{ url('headmaster/whereabouts/edit/' . $value->id) }}" class="btn btn-primary btn-sm">Update</a>
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