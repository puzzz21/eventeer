@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <br/>
        <br/>
        <br/>
        <br/>

        <center>

            <h1>Find events near you</h1>
            <form class="form-inline" action="{{ route('search') }}" method="post" role="form">
                {{ csrf_field() }}
                {!! csrf_field() !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="text" class="form-control" size="30" placeholder="location" name="location">
                <input type="text" class="form-control" size="30" placeholder="tags" name="tags">
                <input type="text" class="form-control datetimepicker3" size="30" placeholder="date" name="searchDate" value="{{ old('searchDate')}}">

                <button type="submit" class="btn btn-success" style="height:50px;width:130px;font-size:20px;color:white;" value="Search!">Search!</button>

            </form>
        </center>

        <br/>
        <br/>

        <div class="row text-center">
            <h3>Your search results...</h3> <br/>
            @if( $result == "no result found")
                {{ $result }}
            @else
                @foreach($result as $a)

                    <div class="col-sm-3">


                        <div class="thumbnail">
                            <img src="{{ asset('public/upload/'.  $a->logo ) }}" style="height:250px;width:450px;"/>


                            <center>
                                <p><strong> {{ $a->event_name }} </strong></p>

                                <p>{{  $a->venue }}</p>
                                <p>{{ $a->event_start_datetime }}</p>
                                <a href=" {{ URL::to('/events/'. $a->id) }}">
                                    <button class="btn btn-primary">Details...</button>
                                </a>
                            </center>
                        </div>


                    </div>

                @endforeach
            @endif

        </div>
    </div>


@endsection
@section('script')
    <script src="{{asset('js/jquery.datetimepicker.full.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/jquery.datetimepicker.css')}}"/ >

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $('.datetimepicker3').datetimepicker({
            format: 'd.m.Y',
            timepicker: false,
            lang: 'ru'
        });
    </script>
@endsection