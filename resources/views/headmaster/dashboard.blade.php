@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Dashboard</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- Total Whereabouts -->
                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="small-box bg-info shadow-sm rounded">
                        <div class="inner text-center">
                            <h3>{{ $TotalWhereabouts }}</h3>
                            <p>Total Whereabouts On Hold</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <a href="{{ url('headmaster/whereabouts/list') }}" class="small-box-footer d-block text-center py-2">
                            More info <i class="fas fa-arrow-circle-right ml-1"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

@endsection