@extends('layouts.app')

@section('content')
    <br/>
    <br/>
    <br/>
    <br/>
    <div class="container-fluid">
        <center><h1>Recommeded Events</h1></center>
        <div class="row">
            @foreach($event_interestArray as $event_interest)
                @foreach($event_interest as $event)
                    <div class="col-sm-3">


                        <div class="thumbnail" id="eventThumbnail">
                            <img src="{{ asset('public/upload/'.  $event->logo ) }}" style="height:250px;width:450px;"/>


                            <center>

                                <p><strong> {{ $event->event_name }} </strong></p>

                                <p>{{  $event->venue }}</p>
                                <p>{{ $event->event_start_datetime }}</p>
                                <a href="{{ URL::to('events/'.$event->id) }}">
                                    <button class="btn btn-primary">Details...</button>
                                </a>
                            </center>
                        </div>


                    </div>
                @endforeach
            @endforeach

        </div>

        <br/>
        <hr>
        <br/>
        <center><h1>Events</h1></center>

        <div class="row text-center">

            @foreach($events as $event)
                <div class="col-sm-3">


                    <div class="thumbnail" id="eventThumbnail">
                        <img src="{{ asset('public/upload/'.  $event->logo ) }}" style="height:250px;width:450px;"/>


                        <center>

                            <p><strong> {{ $event->event_name }} </strong></p>

                            <p>{{  $event->venue }}</p>
                            <p>{{ $event->event_start_datetime }}</p>
                            <a href="{{ URL::to('events/'.$event->id) }}">
                                <button class="btn btn-primary">Details...</button>
                            </a>
                        </center>
                    </div>


                </div>

            @endforeach


        </div>
    </div>
@endsection
