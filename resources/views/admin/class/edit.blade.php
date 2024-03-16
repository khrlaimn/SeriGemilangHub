@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Class</h1> <!-- Page title -->
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <!-- Form -->
                        <form method="post" action="">
                            <!-- CSRF Token -->
                            {{ csrf_field() }}
                            <div class="card-body">
                                <!-- Name Field -->
                                <div class="form-group">
                                    <label>Class Name</label> <!-- Input for class name -->
                                    <input type="text" class="form-control" value="{{ $getRecord->name }}" name="name" required placeholder="Class name">
                                </div>
                                <div class="form-group">
                                    <label>Status</label> <!-- Dropdown for status -->
                                    <select class="form-control" name="status">
                                        <option {{ ($getRecord->status == 0) ? 'selected' : '' }} value="0">Active</option>
                                        <option {{ ($getRecord->status == 1) ? 'selected' : '' }} value="1">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Form Footer -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button> <!-- Submit button -->
                            </div>
                        </form>
                        <!-- End Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

@endsection