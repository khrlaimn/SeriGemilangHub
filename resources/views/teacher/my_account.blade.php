@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>My Account</h1>
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
                        <!-- Profile Picture -->
                        <div class="card-header" style="background-color: #f2f2f2;">
                            <div class="text-center">
                                <img src="{{ $getRecord->getProfile() }}" style="width: 150px; height: 150px; border-radius: 50%;" alt="Profile Picture">
                            </div>
                        </div>


                        <!-- Form -->
                        <form method="post" action="" enctype="multipart/form-data">
                            <!-- CSRF Token -->
                            {{ csrf_field() }}
                            <div class="card-body">
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
                                            <option value="">Select Religion</option>
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

                                    <!-- Status Field -->
                                    <div class="form-group col-md-6">
                                        <label>Status <span style="color:red;">*</span> </label>
                                        <select class="form-control" required name="status">
                                            <option value="">Select Status</option>
                                            <option {{ (old('status', $getRecord->status) == 0) ? 'selected' : '' }} value="0">Active</option>
                                            <option {{ (old('status', $getRecord->status) == 1) ? 'selected' : '' }} value="1">Inactive</option>
                                        </select>
                                    </div>

                                    <!-- Profile Picture Field -->
                                    <div class="form-group col-md-6">
                                        <label>Profile Picture <span style="color:red;">*</span> </label>

                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="profile_pic" name="profile_pic" accept="image/*">
                                            <label class="custom-file-label" for="profile_pic">Choose file</label>
                                        </div>
                                        @error('profile_pic')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                        <!-- Display current profile picture if exists -->
                                        @if(!empty($getRecord->getProfile()))
                                        <div class="mt-2">
                                            <img src="{{ $getRecord->getProfile() }}" style="width: auto; height: 100px;" alt="Current Profile Picture">
                                        </div>
                                        @endif
                                    </div>



                                    <!-- Email Field -->
                                    <div class="form-group col-md-12">
                                        <label>Email <span style="color:red;">*</span> </label>
                                        <input type="email" class="form-control" value="{{ old('email', $getRecord->email) }}" name="email" required placeholder="Email">
                                        <!-- Displaying Validation Error -->
                                        <div style="color:red">{{ $errors->first('email') }}</div>
                                    </div>
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