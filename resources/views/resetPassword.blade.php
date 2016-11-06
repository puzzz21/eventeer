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
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="contactModal">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content" id="contents">

            </div>
        </div>
    </div>

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

                    <div class="tab-pane fade in active" id="profile" role="tabpanel">
                        </div>
                <!--Panel 2-->
                <div class="tab-pane fade" id="event" role="tabpanel">
                    <div class="row">
                        <center><p>
                            <h3> Events you created</h3></p></center>
                        @if($eventt==[])
                            <center><p>no events created by you</p></center>


                        @else

                            <table class="table" style="width:50%;">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Events</th>
                                    <th>Actions
                                        <div id="gn"></div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($eventt as $e)
                                    <tr>
                                        <td class="counterCell"></td>
                                        <td><a href="{{ URL::to('events/'.$e->id) }}"> {{ $e->event_name }}</a></td>
                                        <td>
                                            <?php $id = $e->id; ?>
                                            <input type="hidden" id="idVal" value="{{ $id }}"/>
                                            <a class="teal-text" href=" {{ URL::to('/updateEvent/'. $id) }}"><i class="fa fa-pencil"></i></a>
                                            <a class="red-text" id="del"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <div class="row text-center">
                        <br/>
                        <hr>
                        <br/>
                        <center>
                            <h3>Your upcoming events!!!</h3>
                        </center>
                        @if($going!=[])
                            @foreach($going as $a)

                                <div class="col-md-3" id="thumb">


                                    <div class="thumbnail">
                                        <img src="{{ asset('public/upload/'.  $a->logo ) }}" style="width:400px;height:250px;"/>


                                        <p><strong> {{ $a->event_name }} </strong></p>

                                        <p>{{  $a->venue }}</p>
                                        <p>{{ $a->event_start_datetime }}</p>
                                        <a href="{{ URL::to('events/'.$a->event_id) }}">
                                            <button class="btn btn-primary">Details...</button>
                                        </a>

                                    </div>
                                </div>

                            @endforeach
                        @else
                            <p>
                            <center>You don't have any upcoming events.</center></p>
                        @endif


                        <br/></div>
                    <hr>
                    <br/>
                    <br/>


                    <div class="row text-center">
                        <center>
                            <h3>Events you are might go!!!</h3>
                        </center>
                        <br/><br/>
                        @if($maybe==[])
                            <center>There no events you might go. <br/> <br/></center>
                        @else
                            @foreach($maybe as $a)


                                <div class="col-md-3" id="thumb">


                                    <div class="thumbnail">
                                        <img src="{{ asset('public/upload/'.  $a->logo ) }}" style="width:400px;height:250px;"/>


                                        <p><strong> {{ $a->event_name }} </strong></p>

                                        <p>{{  $a->venue }}</p>
                                        <p>{{ $a->event_start_datetime }}</p>
                                        <a href="{{ URL::to('events/'.$a->event_id) }}">
                                            <button class="btn btn-primary">Details...</button>
                                        </a>

                                    </div>
                                </div>

                            @endforeach
                        @endif

                    </div>


                </div>
            </div>
            <!--/.Panel 2-->

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

    <script type="text/javascript" src="{{ asset('js/oauth.js') }}"></script>
@endsection