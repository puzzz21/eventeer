@extends('layouts.app')

@section('content')
    {{--<div class="container-fluid">--}}
        {{--<div class="row" id="info">--}}

            <!-- Button trigger modal -->
            {{--<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">--}}
                {{--RSVP--}}
            {{--</button>--}}

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            <select id="email" multiple="multiple" name="email"  style="width:500px">
                            </select>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="send_email" data-dismiss="modal">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
    <style>
        #show_first{
            background-image:  url("{{ URL::asset('public/upload/'.  $event->logo ) }}");
            height: 600px;
            background-repeat: no-repeat;
            background-position: right top;
            background-attachment: fixed;
            background-size:     cover;                      /* <------ */
                background-repeat:   no-repeat;
            background-position: center center;
        }
    </style>
    <div class="row">
        <div class="col-md-12" id="show_first">
            <div id="show_name"><center>{{ $event->event_name }}<br/>
                    <h2>
                {{ $event->venue }}
                <br/>
               {{ $event->event_start_datetime }} - {{ $event->event_end_datetime }} </h2></center></div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-6" id="show_desc">
         {{ $event->description }}


            <div id="req">
                <br/>
                <h1> Special Requirement:</h1> <h3> {{  $event->special_requirements }}</h3>
                <h1>
                    Price:
                </h1>
                <h3>
                    {{ $event->price}}
                </h3>


            </div>
        </div>
        <div class="col-md-5">
            <br/>
            <br/>
            <div id="googleMap" style="width:100%;height:500px;"></div>
        </div>
    </div>
<div class="row">
<div id="rsvp">

    <div id="rsvp_content">
        <div id="rsvp_data">
        <h2>Going &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Not Going &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; May be </h2>
            <h3> &nbsp; &nbsp; &nbsp; {{ $going }}  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{ $notgoing }} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{ $maybe }}</h3><br/>

        </div>
        <br/>
        <br/>
        <br/>
        <br/>
        <div id="rsvp_text">
            Are you going?
        </div>

           <a href="#" id="ticket" > <div id="circle_yes" >
                yes

            </div>
           </a>
        &nbsp; &nbsp; &nbsp; &nbsp;
        <a href="#">
            <div id="circle_maybe" >
                may be

            </div>
        </a>
        &nbsp; &nbsp; &nbsp; &nbsp;
        <a href="#">
        <div id="circle_no" >
            no

        </div>
            </a>

        <div id="rsvp-status">
            {{ $aaa }}
        </div>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        {{--data-toggle="modal" data-target="#myModal--}}


        <a href="#" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" >
            <span class="glyphicon glyphicon-envelope"></span> Invite!
        </a>



    </div>
</div>
</div>
@endsection
@section('script')
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <script src="{{asset('js/jquery.datetimepicker.full.min.js')}}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        var address = "{{ $event->venue }}";
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

        function initialize(myCenter) {
            var mapProp = {
                center: myCenter,
                zoom: 5,
                zoomControl: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

            var marker = new google.maps.Marker({
                position: myCenter,
                title: 'Click to zoom'
            });

            marker.setMap(map);
            map.setZoom(15);
            map.setCenter(marker.getPosition());
        }


            getLocation("{{ $event->venue }}", function (latitude, longitude) {
            google.maps.event.addDomListener(window, 'load', initialize(new google.maps.LatLng(latitude, longitude)));
        });
    </script>
    <script>
        var eventId = {{ $event->id }};
        var route = '/rsvp';
        var routemail='/email';

    </script>
    <script src="{{ asset('/js/rsvp.js') }}"></script>
    <script>
        $('#email').select2({
            tags: true,
            tokenSeparators: [','],
            placeholder: "Enter email addresses"
        });
    </script>
    <script>
    $('#ticket').on('click',function() {
        $.ajax({
            url : '/ticket',
            method : 'get'
    });
    });
    </script>
    <script>
        $('#send_email').on('click',function(){
            var email = $("#email").val();

            $.ajax({
               url : '/email',
                method : 'get',
                data : { 'emails' : email, 'urll' : window.location.href ,'event_name' : '{{ $event->event_name }}' ,
                    'event_venue' : '{{ $event->venue }}', 'description' : '{{ $event->description }}' ,
                    'event_start_datetime' : '{{ $event->event_start_datetime }}',
                    'event_end_datetime' : '{{ $event->event_end_datetime }}',
                    'logo' : '{{ $event->logo }}',
                    'address' : '{{ $event->address }}',
                    'city' : '{{ $event->city }}',
                    'country' : '{{ $event->country }}',
                    'event_type' : '{{ $event->event_type }}',
                    'special_requirements' : '{{ $event->special_requirements }}',
                    'price' : '{{ $event->price }}',
                    'logo'  : '{{ $event->logo }}'
                    }
            });
        });
    </script>
@endsection