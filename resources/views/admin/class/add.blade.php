@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Class</h1> <!-- Page title -->
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
                            @csrf <!-- Shorthand for {{ csrf_field() }} -->
                            <div class="card-body">

                                <!-- Class Name Field -->
                                <div class="form-group">
                                    <label>Class Name <span style="color:red;">*</span></label>
                                    <select class="form-control" name="name" required>
                                        <option value="">Select Class Name</option>
                                        <option value="Aktif" {{ old('name') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="Bestari" {{ old('name') == 'Bestari' ? 'selected' : '' }}>Bestari</option>
                                        <option value="Cerdas" {{ old('name') == 'Cerdas' ? 'selected' : '' }}>Cerdas</option>
                                    </select>
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Standard Field -->
                                <div class="form-group">
                                    <label>Standard <span style="color:red;">*</span></label>
                                    <select class="form-control" name="standard" required>
                                        <option value="">Select Standard</option>
                                        @foreach($standards as $standard)
                                        <option value="{{ $standard }}" {{ old('standard') == $standard ? 'selected' : '' }}>{{ $standard }}</option>
                                        @endforeach
                                    </select>
                                    @error('standard')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Year Field -->
                                <div class="form-group">
                                    <label>Year <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="year" required placeholder="Year" value="{{ old('year') }}">
                                    @error('year')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Status Field -->
                                <div class="form-group">
                                    <label>Status <span style="color:red;">*</span></label>
                                    <select class="form-control" name="status" required>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Active</option>
                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <!-- Form Footer -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Add New Class</button> <!-- Submit button -->
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