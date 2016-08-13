@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row text-center" id="sec">
            <h1> {{ $ca }}</h1>
            @if($cat == "non of the defined categories are selected")
                {{ $cat }}
            @else
                @foreach($cat as $a)

                <div class="col-sm-3">


                    <div class="thumbnail">
                        <img src="{{ asset('public/upload/'.  $a->logo ) }}"/>




                        <p><strong> {{ $a->event_name }} </strong></p>

                        <p>{{  $a->venue }}</p>
                        <p>{{ $a->event_start_datetime }}</p>
                        <a href="{{ URL::to('events/'.$a->id) }}"><button class="btn btn-primary">Details...</button></a>
                    </div>


                </div>

            @endforeach
        @endif
        </div>
</div>

@endsection
