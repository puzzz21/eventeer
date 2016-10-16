@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row text-center" id="sec">
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





        <div class="row text-center" id="sec">
            <h1>events you might go</h1> <br/>
            @foreach($maybe as $a)

                <div class="col-sm-3">


                    <div class="thumbnail">
                        <img src="{{ asset('public/upload/'.  $a->logo ) }}"/>




                        <p><strong> {{ $a->event_name }} </strong></p>

                        <p>{{  $a->venue }}</p>
                        <p>{{ $a->event_start_datetime }}</p>
                        <a href="{{ URL::to('events/'.$a->event_id) }}">  <button class="btn btn-primary">Details...</button></a>
                    </div>


                </div>

            @endforeach
        </div>
        <center><a href="#"><h2>see more...</h2></a></center>
        @foreach($events as $event)
            <div class="col-sm-3">


                <div class="thumbnail">
                    <img src="{{ asset('public/upload/'.  $event->logo ) }}"/>




                    <p><strong> {{ $event->event_name }} </strong></p>

                    <p>{{  $event->venue }}</p>
                    <p>{{ $event->event_start_datetime }}</p>
                    <a href="{{ URL::to('events/'.$event->event_id) }}">  <button class="btn btn-primary">Details...</button></a>
                </div>


            </div>

        @endforeach

           <div class="row text-center" id="sec">
            <h1>Events near you</h1> <br/>
            <div class="col-sm-3">
                <div class="thumbnail">
                    <img src="{{ asset('images/a.jpg' ) }}"/>

                    <p><strong>Event name</strong></p>
                    <p>venue</p>
                    <p>start date and time</p>
                    <button class="btn btn-primary">Details...</button>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="thumbnail">
                    <img src="{{ asset('images/a.jpg' ) }}" alt="New York">
                    <p><strong>Event name</strong></p>
                    <p>venue</p>
                    <p>start date and time</p>
                    <button class="btn btn-primary">Details...</button>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="thumbnail">
                    <img src="{{ asset('images/a.jpg' ) }}" alt="San Francisco">
                    <p><strong>Event name</strong></p>
                    <p>venue</p>
                    <p>start date and time</p>
                    <button class="btn btn-primary">Details...</button>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="thumbnail">
                    <img src="{{ asset('images/a.jpg' ) }}" alt="San Francisco">
                    <p><strong>Event name</strong></p>
                    <p>venue</p>
                    <p>start date and time</p>
                    <button class="btn btn-primary">Details...</button>
                </div>
            </div>
            <a href="#"><h2>see more...</h2></a>
        </div>



    </div>
@endsection
