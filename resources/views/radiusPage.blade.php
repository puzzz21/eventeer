@extends('layouts.app')
<br/>
<br/>
<br/>
<div class="container-fluid">
<div class="row">
<div class="col-md-2">
    <br/>
    <br/>
<div class="form">
    <input type="hidden" id="token" value="{{ csrf_token() }}">
    <input type="hidden" id="lat" value="{{ $lat }}">
    <input type="hidden" id="lng" value="{{ $lng }}">

    <div class="md-form">
        <label for="radius" class="label-control">radius (km)</label>
    <input type="text" class="form-control" size="30" id="radius" name="radius">
    </div>
    <div class="md-form">
        <label for="tags" class="label-control">tags</label>
        <input type="text" class="form-control" size="30" id="tags" name="tags" >
    </div>
        <input type="text" class="form-control" size="30" value="categories" name="categories" id="cat" >
    <fieldset class="form-group" id="catChoices">
        <label><input type="checkbox" name="event_type" value="music" id="c"> music</label>
        <br/>
        <label><input type="checkbox" name="event_type" value="technology" id="c"> technology</label>
        <br/>
        <label><input type="checkbox" name="event_type" value="sports & wellness" id="c"> sports & wellness</label>
        <br/>
        <label><input type="checkbox" name="event_type" value="food & drinks" id="c">food & drinks</label>
        <br/>
        <label><input type="checkbox" name="event_type" value="arts" id="c">arts</label>
        <br/>
        <label><input type="checkbox" name="event_type" value="classes" id="c">classes</label>
        <br/>
        <label><input type="checkbox" name="event_type" value="parties" id="c">parties</label>
        <br/>
        <label><input type="checkbox" name="event_type" value="networking" id="c">networking</label>
        <br/>
        <label><input type="checkbox" name="event_type" value="causes" id="c">causes</label>
    </fieldset>
    <div class="md-form">
   <label for="searchDate" class="label-control">date</label>
    <input type="text" class="form-control datetimepicker3" size="30" id="search" name="searchDate" value="{{ old('searchDate')}}">
   </div>
    <input type="hidden" name="checked[]" id="che" multiple="multiple">
    <button class="btn btn-primary" id="submit">Search</button>
</div>

</div>
<div class="col-md-10">
    <div class="card">
        <div class="card-block">
<ul class="nav nav-tabs  md-pills pills-ins" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#map" role="tab" style="color:#2BBBAD;font-size:17px;">
            <i class="fa fa-map-marker fa-3x" style="color:#2BBBAD;"></i><br>MAP</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#list" role="tab" style="color:#2BBBAD;font-size:17px;">
            <i class="fa fa-list fa-3x" style="color:#2BBBAD;"></i><br>
            LIST </a>
    </li>
</ul>

     <div class="tab-content">
    <div class="tab-pane fade in active" id="map" role="tabpanel">
        <div id="ma" style="width:100%; height:83%;"></div>
    </div>
    <div class="tab-pane fade" id="list" role="tabpanel" style="width:100%; height:83%;">
        <br/>
        <div class="card">
            <div class="card-block">
        @foreach($a as $event)

            <div class="col-sm-3">

                <div class="thumbnail">
                    <img src="{{ asset('public/upload/'.  $event->logo ) }}"/>
                    <p><strong> {{ $event->event_name }} </strong></p>
                    <p>{{  $event->venue }}</p>
                    <p>{{ $event->event_start_datetime }}</p>
                    <a href="{{ URL::to('events/'.$event->id) }}">
                        <button class="btn btn-primary">Details...</button>
                    </a>
                </div>

            </div>
        @endforeach
                </div>
            </div>
    </div>
</div>
</div>
    </div>
</div>

    </div>
</div>

{{--<div id="ma" style="width:100%; height: 100%;"></div>--}}
@section('script')
    <script src="{{asset('js/radius.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0WD0EXUROBRkzi4cwJYZETuzDzBPQUgw&callback=initMap"></script>
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
    <script>
        $('.datetimepicker3').datetimepicker({
            format: 'd.m.Y',
            timepicker: false,
            lang: 'ru'
        });
    </script>
    <script>
        $(document).ready(function(){
            $("#catChoices").hide();
           $("#cat").click(function(){
               $("#catChoices").slideToggle("slow");
           }
           );
            $("#cat").keypress(function(event){
                event.preventDefault();
            });
        });
    </script>
    <script>
        var locations = [
                @foreach($a as $event)
            ["{{ $event->id }}", "{{ $event->event_name }}", "{{ $event->venue }}", "{{ $event->latitude }}", "{{ $event->longitude }}"],
            @endforeach
        ];

        var map = new google.maps.Map(document.getElementById('ma'), {
            zoom: 14,
            center: new google.maps.LatLng("{{ $lat }}", "{{ $lng }}"),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][3], locations[i][4]),
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {

                    window.location.href = "http://localhost:8000/events/" + locations[i][0];
                }
            })(marker, i));

            google.maps.event.addListener(marker, 'mouseover', (function (marker, i) {
                return function () {
                    infowindow.setContent(locations[i][1] + "<br/>" + locations[i][2]);
                    infowindow.open(map, marker);

                }
            })(marker, i));
            google.maps.event.addListener(marker, 'mouseout', (function (marker, i) {
                return function () {
                    infowindow.close();
                }
            })(marker, i));
        }

    </script>
@endsection
