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
                        <form method="post" action=""> <!-- Specify the action URL for form submission -->
                            <!-- CSRF Token -->
                            @csrf <!-- Shorthand for {{ csrf_field() }} -->
                            <div class="card-body">
                                <!-- Class Name Field -->
                                <div class="form-group">
                                    <label>Class Name <span style="color:red;">*</span></label>
                                    <select class="form-control" name="name" required>
                                        <option value="">Select Class Name</option>
                                        <option value="Aktif" {{ $getRecord->name == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="Bestari" {{ $getRecord->name == 'Bestari' ? 'selected' : '' }}>Bestari</option>
                                        <option value="Cerdas" {{ $getRecord->name == 'Cerdas' ? 'selected' : '' }}>Cerdas</option>
                                        <!-- Add more options if needed -->
                                    </select>
                                </div>
                                <!-- Standard Field -->
                                <div class="form-group">
                                    <label>Standard <span style="color:red;">*</span></label> <!-- Dropdown for standard -->
                                    <select class="form-control" name="standard">
                                        <option value="">Select Standard</option>
                                        <option {{ ($getRecord->standard == 1) ? 'selected' : '' }} value="1"> 1</option>
                                        <option {{ ($getRecord->standard == 2) ? 'selected' : '' }} value="2"> 2</option>
                                        <option {{ ($getRecord->standard == 3) ? 'selected' : '' }} value="3"> 3</option>
                                        <option {{ ($getRecord->standard == 4) ? 'selected' : '' }} value="4"> 4</option>
                                        <option {{ ($getRecord->standard == 5) ? 'selected' : '' }} value="5"> 5</option>
                                        <option {{ ($getRecord->standard == 6) ? 'selected' : '' }} value="6"> 6</option>
                                        <!-- Add other standard options here -->
                                    </select>
                                </div>
                                <!-- Year Field -->
                                <div class="form-group">
                                    <label>Year <span style="color:red;">*</span></label> <!-- Input for year -->
                                    <input type="text" class="form-control" value="{{ $getRecord->year }}" name="year" required placeholder="Year">
                                </div>
                                <div class="form-group">
                                    <label>Status <span style="color:red;">*</span></label> <!-- Dropdown for status -->
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