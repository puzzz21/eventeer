@extends('layouts.app')
@section('style')
<link rel="stylesheet" type="text/css"  href= "{{asset('css/jquery.datetimepicker.css')}}"/ >
    <style>
        #tags {
            width:100%
        }
        #desc{
            max-height:500px;
            max-length:500px;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">


                    @if (isset($errors))
                        @foreach ($errors as $error)
                            <span class="help-block">
                                <strong>{{ $error }}</strong>
                            </span>
                        @endforeach
                    @endif


                        <form class="form-horizontal" role="form" method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {!! csrf_field() !!}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="event_name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <paper-input floatingLabel label="Floating Label">

                                    <input type="text" class="form-control" name="event_name" value="{{ old('event_name') }}">
                                    </paper-input>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="venue" class="col-md-4 control-label">Venue</label>
                                <div class="col-md-6">
                                    <input id="venue" type="text" class="form-control" name="venue" value="{{ old('venue') }}">
                                </div>
                            </div>

                            {{--<div class="form-group">--}}
                                {{--<label for="event_date" class="col-md-4 control-label">Registration end date</label>--}}
                                {{--<div class="col-md-6">--}}
                                    {{--<input type="text" class="form-control datetimepicker3" name="event_date" value="{{ old('event_date') }}">--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group">
                                <label for="event_start_datetime" class="col-md-4 control-label">Event Start Date/Time</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control datetimepicker3" name="event_start_datetime" value="{{ old('event_start_datetime') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="event_end_datetime" class="col-md-4 control-label">Event End Date/Time</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control datetimepicker3" name="event_end_datetime" value="{{ old('event_end_datetime') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="logo" class="col-md-4 control-label">Logo</label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control" name="logo" value="{{ old('logo') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="col-md-4 control-label">Event Description</label>
                                <div class="col-md-6">
                                    <textarea name="description" cols="50" rows="10" id="desc"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="special_requirements" class="col-md-4 control-label">Special Requirements</label>
                                <div class="col-md-6">
                                    <textarea name="special_requirements" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="price" class="col-md-4 control-label">Price</label>
                                <div class="col-md-6">
                                    <label><input type="radio" name="price" value="free"> free</label>
                                    <br/>
                                    <label><input type="radio" name="price" value="paid" id="paid"> paid</label>

                                    <input type="text" name="price" class="form-control" id="price"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="event_type" class="col-md-4 control-label">Categories</label>
                                <div class="checkbox col-sm-4">
                                    <label><input type="radio" name="event_type" value="music"> music</label>
                                    <br/>
                                    <label><input type="radio" name="event_type" value="technology"> technology</label>
                                    <br/>
                                    <label><input type="radio" name="event_type" value="sports & wellness"> sports & wellness</label>
                                    <br/>
                                    <label><input type="radio" name="event_type" value="food & drinks">food & drinks</label>
                                    <br/>
                                    <label><input type="radio" name="event_type" value="arts">arts</label>
                                    <br/>
                                    <label><input type="radio" name="event_type" value="classes">classes</label>
                                    <br/>
                                    <label><input type="radio" name="event_type" value="parties">parties</label>
                                    <br/>
                                    <label><input type="radio" name="event_type" value="networking">networking</label>
                                    <br/>
                                    <label><input type="radio" name="event_type" value="causes">causes</label>
                                </div>
                            </div>

                            {{--<div class="form-group">--}}
                                {{--<label for="event_type" class="col-md-4 control-label">Event Type</label>--}}
                                {{--<div class="col-md-6">--}}
                                    {{--<label><input type="radio" name="event_type" value="music"> private</label>--}}
                                    {{--<label><input type="radio" name="event_type" value="technology"> public</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="tags">Countries</label>
                                <div class="col-md-6">
                                <select name="country" class="countries" id="countryId">
                                    <option value="">Select Country</option>
                                </select>
                                </div>
                                </div>




            <div class="form-group">
                <label class="col-md-4 control-label" for="address">States</label>
                <div class="col-md-6">

                <select name="address" class="states" id="stateId">
                    <option value="">Select State</option>
                </select>
                    </div>
                </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="city">City</label>
                                <div class="col-md-6">

                                    <select name="city" class="cities" id="cityId">
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tags" class="col-md-4 control-label">Tags</label>
                                <div class="col-md-6">
                                    <select id="tags" multiple="multiple" name="tags[]">
                                                                 </select>
                                </div>

                            </div>
                            <input name="bbb" id="bbb" type="hidden">

                            <input type="hidden" name="latitude" id="lat">
                            <input type="hidden" name="longitude" id="lng">



                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" id="sub">
                                        <i class="fa fa-btn fa-user"></i> Create
                                    </button>
                                </div>
                            </div>
                            </div>


                        </form>


        </div>
    </div>
@endsection
@section('script')
    {{--<script src="{{asset('js/jquery.js}}"></script>--}}
    {{--<script src="{{url('js/jquery.datagstetimepicker.full.min.js')}}"></script>--}}
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>--}}
    {{--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">--}}
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>--}}
    {{--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>--}}
    <script src="{{asset('js/jquery.datetimepicker.full.min.js')}}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="http://maps.googleapis.com/maps/api/js"></script>

    <script src="http://iamrohit.in/lab/js/location.js"></script>
<script>
    $('.datetimepicker3').datetimepicker({
    format:'d.m.Y H:i',
//    inline:true,
    lang:'ru'
    });
    $(document).ready(function(){
        $("#paid").click(function(){
            $("#price").slideToggle("slow");
        });
        $('#tags').select2({
            tags: true,
            tokenSeparators: [','],
            placeholder: "Add your tags here"
        });
        var opt_vals = [];
        $('select option').each(function() {
            opt_vals.push(($this).text());
            console.log(opt_vals);
        });

        $('#bbb').val(opt_vals);

    });





//$(document)ready(
//            function(){
//                $("#paid").click(function(){
//                    $("#price").slideDown("slow");
//                });
//
//
//            }
//    );

    </script>

    <script>
        $(document).ready(function(){
            $('#sub').click(function(){
            var address = $('#venue').val();
            getLocation(address, function(latitude,longitude){
                $('#lat').val(latitude);
                $('#lng').val(longitude);
            });
            });
        });
    </script>

    <script>
        function getLocation(address, fn) {

            var geocoder = new google.maps.Geocoder();

            geocoder.geocode({'address': address}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    fn(results[0].geometry.location.lat(), results[0].geometry.location.lng());
                }
            });
        }


        {{--function initialize(myCenter) {--}}
            {{--var mapProp = {--}}
                {{--center: myCenter,--}}
                {{--zoom: 5,--}}
                {{--zoomControl: true,--}}
                {{--mapTypeId: google.maps.MapTypeId.ROADMAP--}}
            {{--};--}}

            {{--var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);--}}

            {{--var marker = new google.maps.Marker({--}}
                {{--position: myCenter,--}}
                {{--title: 'Click to zoom'--}}
            {{--});--}}

            {{--marker.setMap(map);--}}
            {{--map.setZoom(15);--}}
            {{--map.setCenter(marker.getPosition());--}}
        {{--}--}}

        {{--getLocation("{{ $event->venue }}", function (latitude, longitude) {--}}
            {{--google.maps.event.addDomListener(window, 'load', initialize(new google.maps.LatLng(latitude, longitude)));--}}
        {{--});--}}
    </script>
@endsection
