@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Homeroom Teacher</h1>
                </div>
            </div>
        </div>
    </section>

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
                        <form method="post" action="{{ route('admin.assign_homeroom_teacher.update', $getRecord->id) }}">
                            <!-- CSRF Token -->
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <!-- Class Selection -->
                                <div class="form-group">
                                    <label>Class <span style="color:red;">*</span> </label>
                                    <select class="form-control" required name="class_id">
                                        <option value="">Select Class</option>
                                        @foreach($getClass as $class)
                                        <option value="{{ $class->id }}" {{ ($class->id == $getRecord->class_id) ? 'selected' : '' }}>
                                            Name: {{ $class->name }}, Grade: {{ $class->standard }}, Year: {{ $class->year }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div style="color:red">{{ $errors->first('class_id') }}</div>
                                </div>

                                <!-- Homeroom Teacher Name Field -->
                                <div class="form-group">
                                    <label>Homeroom Teacher Name <span style="color:red;">*</span> </label>
                                    <select class="form-control" required name="teacher_id">
                                        <option value="">Select Teacher</option>
                                        @foreach($getTeacher as $teacher)
                                        <option value="{{ $teacher->id }}" {{ ($getRecord->teacher_id == $teacher->id) ? 'selected' : '' }}>
                                            {{ $teacher->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div style="color:red">{{ $errors->first('teacher_id') }}</div>
                                </div>

                                <!-- Dropdown for status -->
                                <div class="form-group">
                                    <label>Status <span style="color:red;">*</span></label>
                                    <select class="form-control" name="status">
                                        <option value="0" {{ ($getRecord->status == 0) ? 'selected' : '' }}>Active</option>
                                        <option value="1" {{ ($getRecord->status == 1) ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button> <!-- Submit button -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection