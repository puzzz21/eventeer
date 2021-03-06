@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row text-center" id="bg">
            Eventeer
            <h1>Create, Explore and Inspire</h1>

            <a href="{{ route('events.create') }}" class="btn btn-default btn-lg">Create !</a>
            {{--<button type="button" class="btn btn-default" value="create events" style="height:70px;width: 200px">--}}
            {{--<a href="{{ URL::to('events/create') }}"><h3>CREATE!</h3>--}}
            {{--</a></button>--}}
        </div>

        <div class="row text-center" id="sec">

            {{--<p>Click the button to get your coordinates.</p>--}}

            {{--<button onclick="getLocation()">Try It</button>--}}

            {{--<p id="demo"></p>--}}
            Events near you!
            <br/>
            <h3> Find the events that are listed within your radius.</h3>

            <form class="form-horizontal" role="form" id="sub" method="POST" action="{{ route('radius') }}" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <input type="text" name="radius" placeholder="enter radius(km)" style="width:200px;font-size:20px;"/>
                <input type="hidden" name="lat" id="lat"/>
                <input type="hidden" name="lng" id="lng"/>
                <br/>

                <button type="submit" class="btn btn-success" style="height:50px;width:130px;font-size:20px;color:white;" value="Find!">Find!</button>
            </form>

        </div>

        <div class="row" id="third">
            <center>
                Search
                <h3>Find events of your interest</h3>
                <br/>
                <form class="form-inline" action="{{ route('search') }}" method="post" role="form" id="searchForm">
                    {{ csrf_field() }}
                    {!! csrf_field() !!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <span class="md-form" style="width:50px;">
                        <label for="location" class="control-label" style="color:white;font-size:20px;">location</label>
                        <input type="text" class="form-control" name="location" style="color:white;font-size:20px;">
                    </span>
                    <span class="md-form" style="width:50px;">
                        <label for="tags" class="control-label" style="color:white;font-size:20px;">tags</label>
                        <input type="text" class="form-control" name="tags" style="color:white;font-size:20px;">
                    </span>
                    <span class="md-form" style="width:50px;">
                        <label for="searchDate" class="control-label" style="color:white;font-size:20px;">date</label>
                        <input type="text" class="form-control datetimepicker3" size="30" name="searchDate" style="color:white;font-size:20px;">
                    </span>

                    <button type="submit" class="btn btn-success" style="height:50px;width:130px;font-size:20px;color:white;">Search!</button>
                </form>
            </center>


        </div>
        <div class="row" id="fourth">
            <center>Categories</center>
            <center><h1>Browse by top categories</h1></center>

            <br/>
            <div class="col-sm-4">
                <div class="view hm-zoom">
                    <a href="{{ route('cat', ['music']) }}"><img src="{{ asset('images/music.jpg' ) }}" style="width:100%;height:465px;" alt="music">

                        <div class="mask flex-center">
                            <h3 class="black-text" style="font-size:50px;">music</h3>
                        </div>
                </div>
                {{--<div id="polaroid">--}}

                </a>

            </div>

            <div class="col-sm-2">
                <div class="view hm-zoom">

                    <a href="{{ route('cat', ['technology']) }}"> <img src="{{ asset('images/tech.jpg' ) }}" style="width:100%;height:190px;" alt="technology">

                        <div class="mask flex-center">
                            <h3 class="black-text" style="font-size:25px;">technology</h3>
                        </div
                    </a>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="view hm-zoom">

                    <a href="{{ route('cat', ['sports & wellness']) }}"> <img src="{{ asset('images/sports.jpg' ) }}" style="width:100%;height:190px;" alt="sports">
                        <div class="mask flex-center">
                            <h3 class="black-text" style="font-size:25px;">sports & wellness</h3>
                        </div
                    </a>
                </div>
            </div>


            <div class="col-sm-2">
                <div class="view hm-zoom">

                    <a href="{{ route('cat', ['classes']) }}"><img src="{{ asset('images/class.jpg' ) }}" style="width:100%;height:190px;" alt="class">
                        <div class="mask flex-center">
                            <h3 class="black-text" style="font-size:25px;">classes</h3>
                        </div
                    </a>
                </div>
            </div>


            <div class="col-sm-2">
                <div class="view hm-zoom">

                    <a href="{{ route('cat', ['food & drinks']) }}"> <img src="{{ asset('images/food.jpg' ) }}" style="width:100%;height:190px;" alt="food">
                        <div class="mask flex-center">
                            <h3 class="black-text" style="font-size:25px;">food & drinks</h3>
                        </div
                    </a>
                </div>
            </div>


            <div class="col-sm-2">
                <div class="view hm-zoom">
                    <br/>


                    <a href="{{ route('cat', ['arts']) }}"> <img src="{{ asset('images/arts.jpg' ) }}" style="width:100%" alt="arts">
                        <div class="mask flex-center">
                            <h3 class="black-text" style="font-size:25px;">arts</h3>
                        </div
                    </a>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="view hm-zoom">
                    <br/>
                    <a href="{{ route('cat', ['causes']) }}"><img src="{{ asset('images/causes.jpg' ) }}" style="width:100%;height:190px;" alt="causes">
                        <div class="mask flex-center">
                            <h3 class="black-text" style="font-size:25px;">causes</h3>
                        </div
                    </a>
                </div>

            </div>
            <div class="col-sm-2">
                <div class="view hm-zoom">
                    <br/>
                    <a href="{{ route('cat', ['parties']) }}"> <img src="{{ asset('images/party.jpg' ) }}" style="width:100%;height:190px;" alt="party">
                        <div class="mask flex-center">
                            <h3 class="black-text" style="font-size:25px;">parties</h3>
                        </div
                    </a>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="view hm-zoom">
                    <br/>
                    <a href="{{ route('cat', ['networking']) }}"><img src="{{ asset('images/nw.jpg' ) }}" style="width:100%;height:190px;" alt="nw">
                        <div class="mask flex-center">
                            <h3 class="black-text" style="font-size:25px;">networking</h3>
                        </div
                    </a>
                </div>
            </div>
            {{--<div id="polaroid_text">music</div>--}}
            {{--</div>--}}
        </div>

    </div>

    {{--<div class="row">--}}
    {{--<div class="col-md-10 col-md-offset-1">--}}
    {{--<div class="panel panel-default">--}}
    {{--<div class="panel-heading">Dashboard</div>--}}

    {{--<div class="panel-body">--}}
    {{--You are logged in!--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    </div>
@endsection
@section('script')
    <script src="{{asset('js/jquery.datetimepicker.full.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/jquery.datetimepicker.css')}}"/ >
    <link rel="stylesheet" type="text/css" href="{{asset('css/mdb.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('mdb.min.css')}}"/>
    <script src="{{asset('js/mdb.js')}}"></script>
    <script src="{{asset('js/mdb.min.js')}}"></script>
    <script src="{{asset('js/tether.js')}}"></script>
    <script src="{{asset('js/tether.min.js')}}"></script>
    <style type="text/css">
        @font-face {
            font-family: Roboto-Regular;
            src: url('{{ public_path('fonts/roboto/Roboto-Regular.tff') }}');
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0WD0EXUROBRkzi4cwJYZETuzDzBPQUgw&callback=initMap"></script>
    <script>
        $('.datetimepicker3').datetimepicker({
            format: 'd.m.Y',
            timepicker: false,
            lang: 'ru'
        });

        //    $(document).ready(function(){
        //        $("#sub").submit(function(event){
        //            document.getElementById("lat").value="5345";
        //
        //            getLocation();
        //        });
        //    });


        $(document).ready(function () {

            $("#sub").submit(function (event) {
                var form = $(this);


//                console.log(e);
                event.preventDefault();

                getLocation(form, event);
//            form.unbind(event);
//            form.trigger('submit');
            });
        });

        function getLocation(form, event) {
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(showPosition);
                form.unbind(event);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            document.getElementById("lat").value = position.coords.latitude;
            document.getElementById("lng").value = position.coords.longitude;

            $('#sub').trigger('submit');
        }
    </script>
@endsection