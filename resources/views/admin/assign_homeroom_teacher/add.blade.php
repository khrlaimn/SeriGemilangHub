@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Assign New Homeroom Teacher</h1> <!-- Page title -->
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
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Class Name <span style="color:red;">*</span> </label>
                                    <select class="form-control" required name="class_id">
                                        <option value="">Select Class</option>
                                        @foreach($getClass as $class)
                                        <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                            Name: {{ $class->name }}, Grade: {{ $class->standard }}, Year: {{ $class->year }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div style="color:red">{{ $errors->first('class_id') }}</div>
                                </div>

                                <div class="form-group">
                                    <label>Homeroom Teacher Name <span style="color:red;">*</span> </label>
                                    <select class="form-control" required name="teacher_id">
                                        <option value="">Select Teacher</option>
                                        @foreach($getTeacher as $teacher)
                                        <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div style="color:red">{{ $errors->first('teacher_id') }}</div>
                                </div>


                                <div class="form-group">
                                    <label>Status <span style="color:red;">*</span></label>
                                    <select class="form-control" name="status">
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Active</option>
                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>

                                <!-- Form Footer -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Assign Class Teacher</button> <!-- Submit button -->
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