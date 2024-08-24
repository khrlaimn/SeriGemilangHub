@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Whereabouts</h1>
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
                        <form method="post" action="{{ route('teacher.whereabouts.update', $getRecord->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
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
                                    <!-- Remark Field -->
                                    <div class="form-group col-md-10">
                                        <label>Remark <span style="color:red;">*</span></label>
                                        <textarea id="compose-textarea" name="remark" class="form-control" style="height: 100px" required>{{ old('remark', $getRecord->remark) }}</textarea>
                                    </div>

                                    <!-- Date Field -->
                                    <div class="form-group col-md-10">
                                        <label>Date <span style="color:red;">*</span></label>
                                        <input type="date" class="form-control" name="whereabouts_date" required value="{{ old('whereabouts_date', $getRecord->whereabouts_date) }}">
                                    </div>

                                    <!-- Proof Picture Field -->
                                    <div class="form-group col-md-6">
                                        <label>Proof Picture</label>
                                        <input type="file" class="form-control" name="proof_pic" accept="image/*">
                                        @error('proof_pic')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        @if(!empty($getRecord->getProof()))
                                        @endif
                                        <img src="{{ $getRecord->getProof() }}" style="width: auto; height: 100px;" alt="No picture">
                                    </div>


                                </div>


                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update Whereabouts</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection