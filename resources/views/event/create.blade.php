@extends('layouts.app')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/jquery.datetimepicker.css')}}"/ >
    <style>
        #tags {
            width: 100%;

        }

        #desc {
            max-height: 500px;
            max-length: 500px;
        }

        #abc {
            border: 0;
        }

        #fnt {
            color: #616161;
            font-size: 16px;
        }

        #cardTag {
            padding: 5px;
        }

        #left {
            padding: 10px;
        }

        #right {
            padding: 50px;
        }

        body {
            background: #eceff1;
        }

        .card {
            background: white;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid create">
        <div class="row">
            <form class="form-horizontal" role="form" method="POST" id="sub" action="{{ route('events.store') }}" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>


                <div class="col-md-3" id="left">


                    <br/>

                    <div class="form-group">

                        <div class="col-md-8" style="margin-left:55px;">
                            <select id="tags" multiple="multiple" name="tags[]">
                            </select>
                        </div>
                    </div>
                    <br/>


                    <div class="col-md-8 form-group" id="fnt" style="margin-left:50px;">
                        <input type="text" class="form-control" size="30" placeholder="categories" name="categories" id="cat">

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
                        <div class="file-field">
                            <div class="btn col-md-12" style="background:#4B515D;">
                                <span>Choose image for your event</span>
                                <input type="file" name="logo" value="{{ old('logo') }}" accept='image/*'>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-md-9">
                    <div class="card" id="right">
                        <div class="card-block">

                            <div class="md-form">
                                <input type="text" id="title" name="event_name" class="form-control" value="{{ old('event_name') }}" required="true">
                                <label for="title">Event Title</label>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="md-form">
                                        <label for="event_start_datetime">Event Start Date/Time</label>

                                        <input type="text" class="form-control datetimepicker3" name="event_start_datetime" value="{{ old('event_start_datetime') }}" required="true">

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="md-form">
                                        <label for="event_end_datetime">Event End Date/Time</label>

                                        <input type="text" required="true" class="form-control datetimepicker3" name="event_end_datetime" value="{{ old('event_end_datetime') }}" required="true">

                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="form-group" style="margin-left:15px;float:left;">

                                    <label class="control-label" for="country" id="fnt">Country</label>


                                    <select name="country" class="countries mdb-select" id="countryId" style="margin-left:20px;">
                                        <option value="">Select Country</option>
                                    </select>

                                </div>


                            </div>
                            <div class="row">
                                <div class="form-group" style="margin-left:0px;float:left;">
                                    <label class="col-md-4 control-label" for="address" id="fnt">State</label>
                                    <div class="col-md-6">

                                        <select name="address" class="states" id="stateId">
                                            <option value="">Select State</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group" style="margin-left:0px;padding-left:0px;float:left;">
                                    <label class="col-md-4 control-label" for="city" id="fnt">City</label>
                                    <div class="col-md-6">

                                        <select name="city" class="cities" id="cityId">
                                            <option value="">Select City</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="row">

                                <div class="md-form" style="margin-left:15px;float:left;">
                                    <label for="venue" class="control-label">Venue</label>

                                    <input id="venue" type="text" class="form-control" name="venue" value="{{ old('venue') }}" required="true">

                                </div>
                            </div>


                            <div class="md-form">
                                <textarea id="abc" style="overflow-y: scroll;resize: none; height:150px" name="description" class="md-textarea" rows="10" value="{{ old('event_name') }}"
                                          required="true"></textarea>
                                <label for="abc">Event Desciption</label>
                            </div>


                            <div class="form-group" style="margin-left:5px;">
                                <label for="price" id="fnt">Price</label>

                                <label><input type="radio" name="price" value="free" style="margin-left:50px;" id="free"> free</label>
                                <label><input type="radio" name="price" value="paid" id="paid" style="margin-left:200px;"> paid</label>

                                <input type="text" name="price" class="form-control" id="price"></textarea>

                            </div>
                            <div class="form-group" style="margin-left:5px;">
                                <label for="req" id="fnt">Registration</label>

                                <label><input type="radio" name="registration" value="required" id="req" style="margin-left:50px;" > required</label>
                                <label><input type="radio" name="registration" value="not required" id="notreq" style="margin-left:200px;"> not required</label>

                            </div>
                            <div class="form-group" style="margin-left:5px;">
                                <label for="seats" id="fnt">Price</label>

                                <label><input type="radio" name="seats" value="open" style="margin-left:50px;" id="open"> open</label>
                                <label><input type="radio" name="seats" value="limited" id="limited" style="margin-left:200px;"> limited</label>

                                <input type="text" name="seats" class="form-control" id="seat"></textarea>

                            </div>
                            <div class="md-form">
                                <label for="special_requirements">Special Requirements</label>

                                <textarea name="special_requirements" style="overflow-y: scroll;resize: none; height:120px" rows="7" class="md-textarea"></textarea>
                            </div>
                            <input type="hidden" name="latitude" id="lat">
                            <input type="hidden" name="longitude" id="lng">
                            <input type="hidden" name="checked[]" id="che" multiple="multiple">
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <input type="submit" class="btn btn-primary" value="Create">
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')

    <script src="{{asset('js/jquery-2.2.3.js')}}"></script>
    <script src="{{asset('js/jquery-2.2.3.min.js')}}"></script>
    <script src="{{asset('js/jquery.datetimepicker.full.min.js')}}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0WD0EXUROBRkzi4cwJYZETuzDzBPQUgw&callback=initMap"></script>
    <script src="http://iamrohit.in/lab/js/location.js"></script>

    <script>

        $('#textarea1').trigger('autoresize');
        $('.datetimepicker3').datetimepicker({
            format: 'd.m.Y H:i',
//    inline:true,
            lang: 'ru'
        });

        function getLocation(address, fn) {

            var geocoder = new google.maps.Geocoder();

            geocoder.geocode({'address': address}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    fn(results[0].geometry.location.lat(), results[0].geometry.location.lng(), $('#sub'));
                }
            });
        }

        $(document).ready(function () {
            $("#catChoices").hide();
            $("#cat").click(function () {
                        $("#catChoices").slideToggle("slow");
                    }
            );
            $("#cat").keypress(function (event) {
                event.preventDefault();
            });

            $('#sub').submit(function (event) {
                var form = $(this);
                event.preventDefault();
                var abb = [];
                $.each($("input[name='event_type']:checked"),
                        function () {
                            abb.push($(this).val());
                        });
                $('#che').val(abb);


                var address = $('#venue').val();
                getLocation(address, function (latitude, longitude, form) {
                    $('#lat').val(latitude);
                    $('#lng').val(longitude);

                    form.unbind(event);

                    form.trigger('submit');
                });
            });

            $("#price").keyup(function (e) {
                if ((e.keyCode > 47 && e.keyCode < 58) || (e.keyCode == 8) || (e.keyCode == 9) || (e.keyCode >= 16 && e.keyCode <= 20) || (e.keyCode == 27) || (e.keyCode >= 32 && e.keyCode <= 46)) {
                    $("#price").val(e.value());
                }
                else {
                    $("#price").val(" ");

                }


            });

            $("#paid").click(function () {
                $("#price").slideDown("slow");

            });
            $("#free").click(function () {
                $("#price").slideUp("slow");
            });





            $("#seat").hide();

            $("#seat").keyup(function (e) {
                if ((e.keyCode > 47 && e.keyCode < 58) || (e.keyCode == 8) || (e.keyCode == 9) || (e.keyCode >= 16 && e.keyCode <= 20) || (e.keyCode == 27) || (e.keyCode >= 32 && e.keyCode <= 46)) {
                    $("#seat").val(e.value());
                }
                else {
                    $("#seat").val(" ");

                }


            });

            $("#limited").click(function () {
                $("#seat").slideDown("slow");

            });
            $("#open").click(function () {
                $("#seat").val("0");
                $("#seat").slideUp("slow");
            });




            $('#tags').select2({
                tags: true,
                tokenSeparators: [','],
                placeholder: "Add your tags here"
            });
            var opt_vals = [];
            $('select option').each(function () {
                opt_vals.push($(this).text());
                console.log(opt_vals);
            });

            $('#bbb').val(opt_vals);

        });

    </script>

@endsection
