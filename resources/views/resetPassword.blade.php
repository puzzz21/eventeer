@extends('layouts.app')
@section('style')
    <style>

        .hovereffect {
            width: 74%;
            height: 100%;
            float: left;
            overflow: hidden;
            position: relative;
            text-align: center;
            cursor: default;
        }

        .hovereffect .overlay {
            width: 80%;
            position: absolute;
            overflow: hidden;
            left: 0;
            top: auto;
            bottom: 0;
            padding: 1em;
            height: 7.75em;
            background: white;
            color: #3c4a50;
            -webkit-transition: -webkit-transform 0.35s;
            transition: transform 0.35s;
            -webkit-transform: translate3d(0, 100%, 0);
            transform: translate3d(0, 100%, 0);
        }

        .hovereffect img {
            display: block;
            position: relative;
            -webkit-transition: -webkit-transform 0.35s;
            transition: transform 0.35s;
        }

        .hovereffect:hover img {
            -webkit-transform: translate3d(0, -10%, 0);
            transform: translate3d(0, -10%, 0);
        }

        .hovereffect h2 {
            text-transform: uppercase;
            color: #fff;
            text-align: center;
            position: relative;
            font-size: 17px;
            padding: 10px;
            background: rgba(0, 0, 0, 0.6);
            float: left;
            margin: 0px;
            display: inline-block;
        }

        .hovereffect a.info {
            display: inline-block;
            text-decoration: none;
            padding: 7px 14px;
            text-transform: uppercase;
            color: #fff;
            border: 1px solid #fff;
            margin: 50px 0 0 0;
            background-color: transparent;
        }

        .hovereffect a.info:hover {
            box-shadow: 0 0 5px #fff;
        }

        .hovereffect p.icon-links a {
            float: right;
            color: #3c4a50;
            font-size: 1.4em;
        }

        .hovereffect:hover p.icon-links a:hover,
        .hovereffect:hover p.icon-links a:focus {
            color: #252d31;
        }

        .hovereffect h2,
        .hovereffect p.icon-links a {
            -webkit-transition: -webkit-transform 0.35s;
            transition: transform 0.35s;
            -webkit-transform: translate3d(0, 200%, 0);
            transform: translate3d(0, 200%, 0);
        }

        .hovereffect p.icon-links a span:before {
            display: inline-block;
            padding: 8px 10px;
            speak: none;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .hovereffect:hover .overlay,
        .hovereffect:hover h2,
        .hovereffect:hover p.icon-links a {
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        .hovereffect:hover h2 {
            -webkit-transition-delay: 0.05s;
            transition-delay: 0.05s;
        }

        .hovereffect:hover p.icon-links a:nth-child(3) {
            -webkit-transition-delay: 0.1s;
            transition-delay: 0.1s;
        }

        .hovereffect:hover p.icon-links a:nth-child(2) {
            -webkit-transition-delay: 0.15s;
            transition-delay: 0.15s;
        }

        .hovereffect:hover p.icon-links a:first-child {
            -webkit-transition-delay: 0.2s;
            transition-delay: 0.2s;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <div class="col-md-3 col-md-offset-1">
            <div class="row">
                <div class="hovereffect">
                    <img src="/images/uploads/avatar/{{ auth()->user()->avatar }}" style="width:270px; height:270px;" class="img-rounded"/>

                    <div class="overlay">
                        <form id="frm" enctype="multipart/form-data" action="{{ route('avatar') }}" method="POST">
                            <input type="file" name="avatar">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-default" value="upload new picture">
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <h2> {{ auth()->user()->name }}</h2>
                <hr>
                <div class="col-md-5">
                    <ul class="nav" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ URL::to('/profile') }}" role="tab"><i class="fa fa-user"></i> Profile Setting</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#event" role="tab"><i class="fa  fa-cog"></i> Events Setting</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="{{ route('reset.password') }}" role="tab"><i class="fa fa-lock"></i> Password</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#contact" role="tab"><i class="fa fa-envelope"></i> Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#sync" role="tab"><i class="fa fa-calendar "></i> Sync</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 offset-md-2">
            <div class="tab-content">

                @if(session()->has('message'))
                    <div>{{ session()->get('message') }}</div>
                @endif

                @if($errors->has())
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                @endif

                <div class="form">
                    <form action="{{ route('password') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="password" name="current_pass" class="form-control" id="current" placeholder="Current Password">
                        {{--<label for="address">Current password</label>--}}
                        <input type="password" name="new_pass" class="form-control" id="new" placeholder="New Password">
                        {{--<label for="address">New password</label>--}}
                        <input type="password" name="re_new_pass" class="form-control" id="re" placeholder="Retype New Password">
                        {{--<label for="address">Re-type new password</label>--}}

                        <input type="submit" value="Submit" class="btn btn-success btn-xs">
                    </form>
                </div>

                <!--Panel 3-->
                <div class="tab-pane fade" id="password" role="tabpanel">
                    <br>
                    <div id="rrr" class="alert alert-info"></div>


                    {{--<div class="form">--}}
                    {{--<meta name="csrf-token" content="{{ csrf_token() }}" />--}}

                    {{--<div class="md-form">--}}
                    {{--<input type="password" name="current_pass" class="form-control" id="current">--}}
                    {{--<label for="address">Current password</label>--}}
                    {{--</div>--}}
                    {{--<div class="md-form">--}}
                    {{--<input type="password" name="new_pass" class="form-control" id="new">--}}
                    {{--<label for="address">New password</label>--}}
                    {{--</div>--}}


                    {{--<div class="md-form">--}}
                    {{--<input type="password" name="re_new_pass" class="form-control" id="re">--}}
                    {{--<label for="address">Re-type new password</label>--}}
                    {{--</div>--}}
                    {{--<button id="fff" class="btn btn-default">update!</button>--}}
                    {{--</div>--}}
                </div>
                <!--/.Panel 3-->

                <!--Panel 4-->
                <div class="tab-pane fade" id="contact" role="tabpanel">
                    contact
                </div>
                <!--/.Panel 4-->

                <!--Panel 5-->
                <div class="tab-pane fade" id="sync" role="tabpanel">
                    sync
                </div>
                <!--/.Panel 5-->




            </div>



        </div>
    </div>
@endsection
@section('script')
    {{--<script src="{{ asset('js/password.js') }}"></script>--}}
    <script src="http://iamrohit.in/lab/js/location.js"></script>
    <script>
        $("#catChoices").hide();
        $("#cat").click(function () {
                    $("#catChoices").slideToggle("slow");
                }
        );
        $("#cat").keypress(function (event) {
            event.preventDefault();
        });

    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection