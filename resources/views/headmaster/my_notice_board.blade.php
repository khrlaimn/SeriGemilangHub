@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>My Notice Board</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <!-- Search Admin card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Search Notice Board</h3>
                        </div>
                        <!-- Search form -->
                        <form method="get" action="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Title</label>
                                        <input type="text" class="form-control" value="{{ Request::get('title') }}" name="title" placeholder="Title">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Publish Date</label>
                                        <input type="date" class="form-control" value="{{ Request::get('publish_date') }}" name="publish_date">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                                        <a href="{{ url('headmaster/my_notice_board') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    @foreach($getRecord as $value)
                    <!-- Display individual notice board -->
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-body p-0">
                                <div class="mailbox-read-info">
                                    <h5>{{ $value->title }}</h5>
                                    <h6 style="margin-top: 10px;">Published On <strong>{{ date('d-m-Y', strtotime($value->publish_date)) }}</strong></h6>
                                </div>
                                <div class="mailbox-read-message">{!! $value->message !!}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!-- Pagination links -->
                    <div class="col-md-12">
                        <div style="padding: 10px; float:right;">
                            {!! $getRecord->appends(request()->except('page'))->links() !!}
                        </div>
                    </div>


                </div>
            </div>
    </section>
</div>
@endsection