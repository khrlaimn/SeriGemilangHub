@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>View Whereabouts</h1>
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
                                    <!-- Proof Picture Section -->
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                <h5 class="card-title text-center">Proof Picture</h5>
                                            </div>
                                            <div class="card-body text-center">
                                                <img src="{{ $getRecord->getProof() }}" alt="Proof Picture" class="img-fluid rounded-circle" style="max-width: 150px; max-height: 150px;">
                                                <div class="mt-3">
                                                    <!-- Download Button -->
                                                    <a href="{{ $getRecord->getProof() }}" download class="btn btn-primary btn-sm">Download</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Form Section -->
                                    <div class="col-md-8">
                                        <div class="row">
                                            <!-- Teacher Name Field -->
                                            <div class="form-group col-md-6">
                                                <label>Teacher Name</label>
                                                <input type="text" class="form-control" value="{{ $getRecord->createdByUser->name }}" readonly>
                                            </div>



                                            <!-- Remark Field -->
                                            <div class="form-group col-md-12">
                                                <label>Remark</label>
                                                <textarea id="compose-textarea" name="remark" class="form-control" style="height: 100px" disabled>{{ old('remark', $getRecord->remark) }}</textarea>
                                            </div>
                                            <!-- Date Field -->
                                            <div class="form-group col-md-6">
                                                <label>Date</label>
                                                <input type="date" class="form-control" name="whereabouts_date" value="{{ old('whereabouts_date', $getRecord->whereabouts_date) }}" disabled>
                                            </div>
                                            <!-- Status Field -->
                                            <div class="form-group col-md-6">
                                                <label>Status</label>
                                                <select class="form-control" required name="status" disabled>
                                                    <option value="">Select Status</option>
                                                    <option {{ (old('status', $getRecord->status) == 0) ? 'selected' : '' }} value="0">On Hold</option>
                                                    <option {{ (old('status', $getRecord->status) == 1) ? 'selected' : '' }} value="1">Accepted</option>
                                                    <option {{ (old('status', $getRecord->status) == 2) ? 'selected' : '' }} value="2">Rejected</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Footer -->
                            <!-- <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Wherabouts Status</button>
                            </div> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection