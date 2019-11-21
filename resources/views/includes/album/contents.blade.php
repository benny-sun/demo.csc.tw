@extends('layout.album')

@section('menu')

    @include('includes.album.section.menu')

@endsection




@section('header')

    @include('includes.album.header')

@endsection



@section('content')

    @foreach ($items as $row)
        @if ($row->templates == 1)
            <section>
                <div class="container bg-white sectionA">
                    <div class="row">
                        <div class="col-lg-6 col-lg-push-6 col-md-6 col-md-push-6 lg-div">
                            <img class="lazy" data-original="../uploads/{{ $row->main_img }}">
                        </div>
                        <div class="col-lg-6 col-lg-pull-6 col-md-6 col-md-pull-6">
                            <div class="col-md-12 sectionA-info content">
                                <div>
                                    <h1>{{ $row->title }}<small>{{ $row->subtitle }}</small>
                                        @if (!is_null($row->detail) && file_exists('uploads/'.$row->detail))
                                        <a href="../uploads/{{ $row->detail }}" class="btn btn-outline-dark pull-right" data-toggle="lightbox">Info</a>
                                        @endif
                                    </h1>
                                    <hr>
                                    <p>{!! nl2br($row->content) !!}</p>
                                </div>
                                <div class="sectionA-frame">
                                    <img class="lazy" data-original="../uploads/{{ $row->sub_img }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @elseif ($row->templates == 2)
            <section class="blade2">
                <div class="container bg-white">
                    <div class="row">
                        <div class="col-lg-6 col-lg-push-6 col-md-6 col-md-push-6">
                            <img class="lazy" data-original="../uploads/{{ $row->main_img }}">
                        </div>
                        <div class="col-lg-6 col-lg-pull-6 col-md-6 col-md-pull-6 field">
                            <div class="content">
                                <div>
                                    <h1>{{ $row->title }}<small>{{ $row->subtitle }}</small>
                                        @if (!is_null($row->detail) && file_exists('uploads/'.$row->detail))
                                        <a href="../uploads/{{ $row->detail }}" class="btn btn-outline-dark pull-right" data-toggle="lightbox">Info</a>
                                        @endif
                                    </h1>
                                    <hr>
                                    <p>{!! nl2br($row->content) !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @elseif ($row->templates == 3)
            <section>
                <div class="container bg-white">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <img class="lazy" data-original="../uploads/{{ $row->main_img }}">
                        </div>
                        <div class="col-lg-6 col-md-6 field">
                            <img class="lazy" data-original="../uploads/{{ $row->sub_img }}">
                        </div>
                    </div>
                </div>
            </section>
        @elseif ($row->templates == 4)
            <section>
                <div class="container bg-white">
                    <div class="row" style="background-color: #1b1b1b;">
                        <div class="col-lg-12 col-md-12" style="padding: 0; position: relative;">
                            <div class="mobile2" >
                                <img class="lazy" data-original="../uploads/{{ $row->main_img }}">
                            </div>
                            @if (!is_null($row->content))
                            <div class="col-lg-6 blade4">
                                <div>
                                    <p>{!! nl2br($row->content) !!}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endforeach

@endsection

@section('contact')

    @include('includes.album.section.contact')

@endsection