@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Whereabout</h1>
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
                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <label>Remark <span style="color:red;">*</span></label>
                                        <textarea id="compose-textarea" name="remark" class="form-control" style="height: 100px" required>{{ old('remark') }}</textarea>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <label>Date <span style="color:red;">*</span></label>
                                        <input type="date" class="form-control" value="{{ old('whereabouts_date') }}" name="whereabouts_date" required>
                                    </div>
                                    <!-- Proof Pic -->
                                    <div class="form-group col-md-6">
                                        <label>Proof Picture</label>
                                        <input type="file" class="form-control" name="proof_pic" accept="image/*">
                                        @error('proof_pic')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <!-- Form Footer -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add New Whereabout</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection