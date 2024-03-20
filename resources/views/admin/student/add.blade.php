@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Student</h1>
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
                                        <label>First Name <span style="color:red;">*</span> </label>
                                        <input type="text" class="form-control" value="{{ old('name') }}" name="name" required placeholder="First Name">
                                        <div style="color:red">{{ $errors->first('name') }}</div>
                                    </div>
                                    <!-- Admission Number Field -->
                                    <div class="form-group col-md-6">
                                        <label>Admission Number <span style="color:red;">*</span> </label>
                                        <input type="text" class="form-control" value="{{ old('admission_number') }}" name="admission_number" required placeholder="Admission Number">
                                        <div style="color:red">{{ $errors->first('admission_number') }}</div>
                                    </div>
                                    <!-- Roll Number Field -->
                                    <div class="form-group col-md-6">
                                        <label>Roll Number <span style="color:red;">*</span> </label>
                                        <input type="text" class="form-control" value="{{ old('roll_number') }}" name="roll_number" required placeholder="Roll Number">
                                        <div style="color:red">{{ $errors->first('roll_number') }}</div>
                                    </div>
                                    <!-- Class Field -->
                                    <div class="form-group col-md-6">
                                        <label>Class <span style="color:red;">*</span> </label>
                                        <select class="form-control" required name="class_id">
                                            <option value="">Select Class</option>
                                            @foreach($getClass as $value)
                                            <option {{ (old('class_id') == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        <div style="color:red">{{ $errors->first('class_id') }}</div>
                                    </div>
                                    <!-- Gender Field -->
                                    <div class="form-group col-md-6">
                                        <label>Gender <span style="color:red;">*</span> </label>
                                        <select class="form-control" required name="gender">
                                            <option value="">Select Gender</option>
                                            <option {{ (old('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                                            <option {{ (old('gender') == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                                        </select>
                                        <div style="color:red">{{ $errors->first('gender') }}</div>
                                    </div>
                                    <!-- Date of Birth Field -->
                                    <div class="form-group col-md-6">
                                        <label>Date of Birth <span style="color:red;">*</span> </label>
                                        <input type="date" class="form-control" value="{{ old('date_of_birth') }}" name="date_of_birth" required>
                                        <div style="color:red">{{ $errors->first('date_of_birth') }}</div>
                                    </div>
                                    <!-- Religion Field -->
                                    <div class="form-group col-md-6">
                                        <label>Religion <span style="color:red;">*</span> </label>
                                        <select class="form-control" required name="religion">
                                            <option value="">Select Religion</option>
                                            <option {{ (old('religion') == 0) ? 'selected' : '' }} value="0">Islam</option>
                                            <option {{ (old('religion') == 1) ? 'selected' : '' }} value="1">Buddhist</option>
                                            <option {{ (old('religion') == 2) ? 'selected' : '' }} value="2">Christians</option>
                                            <option {{ (old('religion') == 3) ? 'selected' : '' }} value="3">Hindus</option>
                                        </select>
                                        <div style="color:red">{{ $errors->first('religion') }}</div>
                                    </div>
                                    <!-- Mobile Number Field -->
                                    <div class="form-group col-md-6">
                                        <label>Mobile Number <span style="color:red;">*</span> </label>
                                        <input type="text" class="form-control" value="{{ old('mobile_number') }}" name="mobile_number" required placeholder="Mobile Number">
                                        <div style="color:red">{{ $errors->first('mobile_number') }}</div>
                                    </div>
                                    <!-- Profile Picture Field -->
                                    <div class="form-group col-md-6">
                                        <label>Profile Picture <span style="color:red;">*</span> </label>
                                        <input type="file" class="form-control" name="profile_pic" accept="image/*" required>
                                        @error('profile_pic')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Status Field -->
                                    <div class="form-group col-md-6">
                                        <label>Status <span style="color:red;">*</span> </label>
                                        <select class="form-control" required name="status">
                                            <option value="">Select Status</option>
                                            <option {{ (old('status') == 0) ? 'selected' : '' }} value="0">Active</option>
                                            <option {{ (old('status') == 1) ? 'selected' : '' }} value="1">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <hr />

                                <!-- Email Field -->
                                <div class="form-group">
                                    <label>Email <span style="color:red;">*</span> </label>
                                    <input type="email" class="form-control" value="{{ old('email') }}" name="email" required placeholder="Email">
                                    <!-- Displaying Validation Error -->
                                    <div style="color:red">{{ $errors->first('email') }}</div>
                                </div>
                                <!-- Password Field -->
                                <div class="form-group">
                                    <label>Password <span style="color:red;">*</span> </label>
                                    <input type="password" class="form-control" name="password" required placeholder="Password">
                                </div>
                            </div>
                            <!-- Form Footer -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add New Student</button>
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