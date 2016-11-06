@extends('layouts.app')
@section('content')
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <div class="container">
    @foreach ($profiles as $profile)
        <div class="row">
            <div class="col-md-4">
                <img src="/images/uploads/avatar/{{ $pic }}" style="width:270px; height:270px;" class="img-rounded"/>

            </div>
            <div class="col-md-8">
               <h3> {{ $profile->name }} </h3>
                <br/>

                <h3><strong> Description</strong></h3>

                {{$profile->desciption}}
                <br/>
                <br/>
                <h3><strong> Interested categories</strong></h3>

                <?php $p=explode(",",$profile->interested_events); ?>
                @foreach($p as $event)
                    {{ $event }} <br/>
                @endforeach
            </div>
        </div>

        <br/>
        <br/>
        <br/>
        <div class="row" id="thumbnailRow">
            <h3><center><strong>Events created by {{ $profile->name }} </strong><center></h3>
            <br/>
            @foreach($events as $event)
                <div class="col-sm-3 col-md-offset-1">


                    <div class="thumbnail" id="eventThumbnail">
                        <img src="{{ asset('public/upload/'.  $event->logo ) }}" style="height:250px;width:450px;"/>


                        <center>

                            <p><strong> {{ $event->event_name }} </strong></p>

                            <p>{{  $event->venue }}</p>
                            <p>{{ $event->event_start_datetime }}</p>
                            <a href="{{ URL::to('events/'.$event->id) }}">  <button class="btn btn-primary">Details...</button></a>
                        </center>
                    </div>


                </div>
            @endforeach



        </div>

        @endforeach


    </div>



@endsection
