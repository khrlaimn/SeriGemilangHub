@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="text-center">Student Details</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header bg-light">
                            <div class="text-center">
                                <img src="{{ $getRecord->getProfile() }}" class="rounded-circle img-fluid" alt="Profile Picture" style="max-width: 150px;">
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-center">Personal Information</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Name:</strong> {{ $getRecord->name }}</li>
                                <li class="list-group-item"><strong>Gender:</strong> {{ $getRecord->gender }}</li>
                                <li class="list-group-item"><strong>Date of Birth:</strong> {{ $getRecord->date_of_birth }}</li>
                                <li class="list-group-item"><strong>Religion:</strong> {{ $getRecord->getReligion() }}</li>
                                <li class="list-group-item"><strong>Mobile Number:</strong> {{ $getRecord->mobile_number }}</li>
                                <li class="list-group-item"><strong>Status:</strong> {{ $getRecord->status == 0 ? 'Active' : 'Inactive' }}</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header bg-light">
                            <h3 class="card-title text-center">Class Information</h3>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><strong>Class:</strong> {{ $getRecord->class->name }}</p>
                            <p class="card-text"><strong>Grade:</strong> {{ $getRecord->class->standard }}</p>
                            <p class="card-text"><strong>Year:</strong> {{ $getRecord->class->year }}</p>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <a href="{{ route('teacher.my_student') }}" class="btn btn-secondary">Back to Student List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection