@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Admin</h1>
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
                        <form method="post" action="" enctype="multipart/form-data">
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
                                <div class="form-group">
                                    <label>Name <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name', $getRecord->name)}}" required placeholder="Name">
                                </div>

                                <!-- Profile Picture Field -->
                                <div class="form-group">
                                    <label>Profile Picture <span style="color:red;">*</span></label>

                                    <input type="file" class="form-control" name="profile_pic" accept="image/*">
                                    @error('profile_pic')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    @if(!empty($getRecord->getProfile()))
                                    @endif
                                    <img src="{{ $getRecord->getProfile() }}" style="width: auto; height: 100px;" alt="No picture">
                                </div>

                                <div class="form-group">
                                    <label>User Type <span style="color:red;">*</span></label>
                                    <select class="form-control" name="user_type" required>
                                        <option value="1" {{ old('user_type', $getRecord->user_type) == 1 ? 'selected' : '' }}>Admin</option>
                                        <option value="4" {{ old('user_type', $getRecord->user_type) == 4 ? 'selected' : '' }}>Headmaster</option>
                                        <option value="5" {{ old('user_type', $getRecord->user_type) == 5 ? 'selected' : '' }}>Student Affairs</option>
                                    </select>
                                </div>


                                <hr />

                                <div class="form-group">
                                    <label>Email <span style="color:red;">*</span></label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email', $getRecord->email)}}" required placeholder="Email">
                                    <div style="color:red"> {{ $errors->first('email')}}</div>
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                    <p>Leave this field blank if you don't want to change the password.</p>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

@endsection