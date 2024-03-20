@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Teacher</h1>
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
                        <form method="post" action="" enctype="multipart/form-data">
                            <!-- CSRF Token -->
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <!-- Name Field -->
                                    <div class="form-group col-md-6">
                                        <label>Name <span style="color:red;">*</span> </label>
                                        <input type="text" class="form-control" value="{{ old('name', $getRecord->name) }}" name="name" required placeholder="First Name">
                                        <div style="color:red">{{ $errors->first('name') }}</div>
                                    </div>

                                    <!-- Gender Field -->
                                    <div class="form-group col-md-6">
                                        <label>Gender <span style="color:red;">*</span> </label>
                                        <select class="form-control" required name="gender">
                                            <option value="">Select Gender</option>
                                            <option {{ (old('gender', $getRecord->gender) == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                                            <option {{ (old('gender', $getRecord->gender) == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                                        </select>
                                        <div style="color:red">{{ $errors->first('gender') }}</div>
                                    </div>

                                    <!-- Date of Birth Field -->
                                    <div class="form-group col-md-6">
                                        <label>Date of Birth <span style="color:red;">*</span> </label>
                                        <input type="date" class="form-control" required value="{{ old('date_of_birth', $getRecord->date_of_birth) }}" name="date_of_birth">
                                        <div style="color:red">{{ $errors->first('date_of_birth') }}</div>
                                    </div>

                                    <!-- Religion Field -->
                                    <div class="form-group col-md-6">
                                        <label>Religion <span style="color:red;">*</span> </label>
                                        <select class="form-control" required name="religion">
                                            <option value="">Select Status</option>
                                            <option {{ (old('religion', $getRecord->religion) == 0) ? 'selected' : '' }} value="0">Islam</option>
                                            <option {{ (old('religion', $getRecord->religion) == 1) ? 'selected' : '' }} value="1">Buddhist</option>
                                            <option {{ (old('religion', $getRecord->religion) == 2) ? 'selected' : '' }} value="2">Christians</option>
                                            <option {{ (old('religion', $getRecord->religion) == 3) ? 'selected' : '' }} value="3">Hindus</option>
                                        </select>
                                        <div style="color:red">{{ $errors->first('religion') }}</div>
                                    </div>

                                    <!-- Mobile Number Field -->
                                    <div class="form-group col-md-6">
                                        <label>Mobile Number <span style="color:red;">*</span> </label>
                                        <input type="text" class="form-control" value="{{ old('mobile_number', $getRecord->mobile_number) }}" name="mobile_number" required placeholder="Mobile Number">
                                        <div style="color:red">{{ $errors->first('mobile_number') }}</div>
                                    </div>

                                    <!-- Profile Picture Field -->
                                    <div class="form-group col-md-6">
                                        <label>Profile Picture <span style="color:red;">*</span> </label>

                                        <input type="file" class="form-control" name="profile_pic" accept="image/*">
                                        @error('profile_pic')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        @if(!empty($getRecord->getProfile()))
                                        @endif
                                        <img src="{{ $getRecord->getProfile() }}" style="width: auto; height: 100px;" alt="No picture">
                                    </div>

                                    <!-- Status Field -->
                                    <div class="form-group col-md-6">
                                        <label>Status <span style="color:red;">*</span> </label>
                                        <select class="form-control" required name="status">
                                            <option value="">Select Status</option>
                                            <option {{ (old('status', $getRecord->status) == 0) ? 'selected' : '' }} value="0">Active</option>
                                            <option {{ (old('status', $getRecord->status) == 1) ? 'selected' : '' }} value="1">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <hr />

                                <!-- Email Field -->
                                <div class="form-group">
                                    <label>Email <span style="color:red;">*</span> </label>
                                    <input type="email" class="form-control" value="{{ old('email', $getRecord->email) }}" name="email" required placeholder="Email">
                                    <!-- Displaying Validation Error -->
                                    <div style="color:red">{{ $errors->first('email') }}</div>
                                </div>
                                <!-- Password Field -->
                                <div class="form-group">
                                    <label>Password <span style="color:red;"></span> </label>
                                    <input type="text" class="form-control" name="password" placeholder="Password">
                                </div>
                            </div>
                            <!-- Form Footer -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
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