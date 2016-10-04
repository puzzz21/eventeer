@extends('layouts.app')

@section('content')
<div class="container-fluid" >
    <div class="row" id="bg">
        <center>
        Eventeer
        <p>
            <h1>create, explore and inspire</h1>
        </p>
            <button type="button" class="btn btn-success" value="create events" style="height:70px;width: 200px"><a href="{{ URL::to('events/create') }}"><h3>CREATE!</h3></a></button>
        </center>
    </div>

    <div class="row text-center" id="sec">

        {{--<p>Click the button to get your coordinates.</p>--}}

        {{--<button onclick="getLocation()">Try It</button>--}}

        {{--<p id="demo"></p>--}}

        <h1>your upcoming events</h1> <br/>
        @foreach($going as $a)

            <div class="col-sm-3">
                <div class="thumbnail">
                    <img src="{{ asset('public/upload/'.  $a->logo ) }}"/>
                    <p><strong> {{ $a->event_name }} </strong></p>
                    <p>{{  $a->venue }}</p>
                    <p>{{ $a->event_start_datetime }}</p>
                    <a href="{{ URL::to('events/'.$a->event_id) }}"><button class="btn btn-primary">Details...</button></a>
                </div>


            </div>

        @endforeach

    </div>
    <center><a href="#"><h2>see more...</h2></a></center>
    <div class="row" id="third">
        <center>
            Search
            <h1>Find events near you</h1>
            <form class="form-inline" action="{{ route('search') }}" method="post" role="form">
                {{ csrf_field() }}
                {!! csrf_field() !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="text" class="form-control" size="30" placeholder="location" name="location">
                <input type="text" class="form-control" size="30" placeholder="tags" name="tags">
                <input type="text" class="form-control datetimepicker3"  size="30" placeholder="date" name="searchDate" value="{{ old('searchDate')}}">

                <input type="submit" class="btn btn-primary"></input>
            </form>
        </center>


    </div>
    <div class="row" id="fourth">
        <center><h1>browse by top categories</h1></center>

        <br/>
        <div class="col-sm-4">
            <div class="abc">
                {{--<div id="polaroid">--}}
                <a href="{{ route('cat', ['music']) }}"><img src="{{ asset('images/music.jpg' ) }}" style="width:100%"  alt="music">
                    <div class="center" style="font-size:50px">music</div></a>
            </div>
        </div>

        <div class="col-sm-2">
            <div class="abc">
                <a href="{{ route('cat', ['technology']) }}"> <img src="{{ asset('images/tech.jpg' ) }}" style="width:100%"  alt="technology">
                    <div class="center">technology</div></a>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="abc">
                <a href="{{ route('cat', ['sports & wellness']) }}"> <img src="{{ asset('images/sports.jpg' ) }}" style="width:100%"  alt="sports">
                    <div class="center">sports & wellness</div></a>
            </div>
        </div>


        <div class="col-sm-2">
            <div class="abc">
                <a href="{{ route('cat', ['classes']) }}"><img src="{{ asset('images/class.jpg' ) }}" style="width:100%"  alt="class">
                    <div class="center">classes</div></a>
            </div>
        </div>


        <div class="col-sm-2">
            <div class="abc">
                <a href="{{ route('cat', ['food & drinks']) }}"> <img src="{{ asset('images/food.jpg' ) }}" style="width:100%"  alt="food">
                    <div class="center">food & drinks</div></a>
            </div>
        </div>


        <div class="col-sm-2">
            <div class="abc">
                <br/>

                <a href="{{ route('cat', ['arts']) }}">  <img src="{{ asset('images/arts.jpg' ) }}" style="width:100%"  alt="arts">
                    <div class="center">arts</div></a>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="abc">
                <br/>

                <a href="{{ route('cat', ['causes']) }}"><img src="{{ asset('images/causes.jpg' ) }}" style="width:100%"  alt="causes">
                    <div class="center">causes</div></a>
            </div>

        </div>
        <div class="col-sm-2">
            <div class="abc">
                <br/>

                <a href="{{ route('cat', ['parties']) }}"> <img src="{{ asset('images/party.jpg' ) }}" style="width:100%"  alt="party">
                    <div class="center">parties</div></a>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="abc">
                <br/>

                <a href="{{ route('cat', ['networking']) }}"><img src="{{ asset('images/nw.jpg' ) }}" style="width:100%"  alt="nw">
                    <div class="center">networking</div></a>
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
    <link rel="stylesheet" type="text/css"  href= "{{asset('css/jquery.datetimepicker.css')}}"/ >

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
    $('.datetimepicker3').datetimepicker({
                format: 'd.m.Y',
                timepicker:false,
                lang:'ru'
            });
    </script>
    <script>
        var x = document.getElementById("demo");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            x.innerHTML="Latitude: " + position.coords.latitude +
                    "<br>Longitude: " + position.coords.longitude;
        }
    </script>
@endsection
