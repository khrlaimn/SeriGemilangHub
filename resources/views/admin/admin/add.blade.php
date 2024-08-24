@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Admin</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <!-- Form -->
                        <form method="post" action="" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <!-- Name Field -->
                                <div class="form-group">
                                    <label>Name <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" value="{{ old('name') }}" name="name" required placeholder="Name">
                                    <!-- Displaying Validation Error -->
                                    <div style="color:red">{{ $errors->first('name') }}</div>
                                </div>
                                <!-- User Type Field -->
                                <div class="form-group">
                                    <label>User Type <span style="color:red;">*</span></label>
                                    <select class="form-control" name="user_type" required>
                                        <option value="1">Admin</option>
                                        <option value="4">Headmaster</option>
                                        <option value="5">Student Affairs</option>
                                    </select>
                                    <!-- Displaying Validation Error -->
                                    <div style="color:red">{{ $errors->first('user_type') }}</div>
                                </div>

                                <!-- Profile Picture Field -->
                                <div class="form-group">
                                    <label>Profile Picture <span style="color:red;">*</span> </label>
                                    <input type="file" class="form-control" name="profile_pic" accept="image/*" required>
                                    @error('profile_pic')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
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
                                    <!-- Displaying Validation Error -->
                                    <div style="color:red">{{ $errors->first('password') }}</div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add New Admin</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection