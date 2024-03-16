@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Change Password</h1> <!-- Page title -->
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
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
                    <div class="card card-primary">
                        <!-- Form -->
                        <form method="post" action="">
                            <!-- CSRF Token -->
                            {{ csrf_field() }}
                            <div class="card-body">
                                <!-- Old Password Field -->
                                <div class="form-group">
                                    <label>Old Password</label> <!-- Input for old password -->
                                    <input type="password" class="form-control" name="old_password" required placeholder="Old Password">
                                </div>
                                <!-- New Password Field -->
                                <div class="form-group">
                                    <label>New Password</label> <!-- Input for new password -->
                                    <input type="password" class="form-control" name="new_password" required placeholder="New Password">
                                </div>
                            </div>
                            <!-- Form Footer -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update New Password</button> <!-- Submit button -->
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