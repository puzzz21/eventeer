@extends('layouts.app')

@section('content')

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Invite</h4>
                </div>
                <div class="modal-body">
                    <br/>
                    <br/>
                    <form action="{{ route('invite-contacts', $event->id) }}" method="POST">
                        {{ csrf_field() }}
                        <select id="email" multiple="multiple" name="group" style="width:500px">
                            @forelse($group_name as $group)
                                {{--@forelse (explode(',', $group->contact_list) as $contact)--}}
                                <option value="{{ $group->id }}">
                                    {{--<ol id="grp">--}}
                                    {{--<a href="#">--}}
                                    {{--<li></li>--}}
                                    {{--</a> &nbsp; &nbsp;--}}
                                    {{--</ol>--}}
                                    {{ $group->group_name }}
                                </option>
                                {{--@empty--}}
                                {{--<p>No contact groups!</p>--}}
                                {{--@endforelse--}}
                                {{--<ul>--}}
                                {{--</ul>--}}
                            @empty
                                <p>No contact groups!</p>
                            @endforelse
                        </select>
                        <input type="submit" class="btn btn-sm btn-primary" value="Confirm">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        {{--<button type="button" class="btn btn-primary" id="send_email" data-dismiss="modal">Confirm</button>--}}
                    </form>
                </div>

                {{--<div class="modal-footer">--}}
                    {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                    {{--<button type="button" class="btn btn-primary" id="send_email" data-dismiss="modal">Confirm</button>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>

    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" id="myModalLabel"><strong>
                            <center>Contact the organizer</center>
                        </strong></h3>
                </div>

                <div class="modal-body">

                    <div class="form" role="form" method="get">
                        {{ csrf_field() }}
                        {!! csrf_field() !!}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                        <input type="hidden" name="idd" id="idd" value="
                        @foreach($creator as $c)
                        {{ $c->id }}
                        @endforeach
                                "/>

                        <div class="md-form">
                            <label for="name">Your name</label>
                            <input type="text" class="form-control" name="name" id="name" required="true">
                        </div>

                        <div class="md-form">
                            <label for="email">Your email</label>
                            <input type="text" class="form-control" name="email" id="add" required="true">
                        </div>

                        <div class="md-form">
                            <label for="msg">Your message</label>
                            <textarea name="msg" style="overflow-y: scroll;resize: none; height:120px" rows="7" id="msg" class="md-textarea" required="true"></textarea>
                        </div>

                        <button id="contactForm" class="btn btn-success" style="height:50px;width:80px;font-size:15px;color:white;" value="Send!">Send!</button>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <style>

        #show_first {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url("{{ URL::asset('public/upload/'.  $event->logo ) }}");
            height: 500px;
            background-repeat: no-repeat;
            background-position: right top;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            position: relative;
            padding-top: 200px;
            padding-left: 15%;

        }

        #ad {
            height: 1400px;
            /*z-index: -1;*/
            position: relative;
        }

        .card {
            background: white;
            width: 80%;
            height: auto;
        }

        #description {
            padding-left: 60px;
        }

        #require {
            padding-left: 150px;
        }

        #map {
            padding: 15px;
            padding-bottom: 0px;
        }

        #disqus_thread {
            margin-left: 200px;
            margin-right: 200px;
            margin-top: 10px;
            padding: 50px;
        }

        .card a {
            color: rgba(0, 150, 136, 0.7);
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div id="ad">
                <div id="show_first">

                    <div class="card">

                        <div class="row">
                            <div class="col-md-8">
                                <img src="{{ asset('public/upload/'.  $event->logo ) }}" style="height:500px;width:750px;"/>

                            </div>
                            <div class="col-md-4">
                                <br/>
                                <h1><strong>{{ $event->event_name }}</strong><br/></h1>
                                <h3>
                                    @foreach($creator as $c)
                                        <a href="{{ URL::to('profile/'.$c->id) }}"> -
                                            {{ $c->name }}
                                        </a>
                                    @endforeach

                                </h3>

                                <hr>
                                <br/>

                                <h4>

                                    @if($event->country && $event->city && $event->address)
                                        <strong>Location</strong>
                                        <br/>
                                        <br/>

                                        {{$event->country}}
                                        <br/>{{$event->city}},{{$event->address}}
                                        <br/>
                                        {{ $event->venue }}

                                    @else
                                        <strong>Location</strong>
                                        <br/>
                                        <br/>
                                        {{ $event->venue }}
                                    @endif

                                    <br/>
                                    <br/>
                                    <br/>
                                    <strong> Date & Time</strong>
                                    <br/>
                                    <br/>

                                    {{ $event->event_start_datetime }} &nbsp; - &nbsp; {{ $event->event_end_datetime }}

                                    <br/>
                                    <br/>
                                    <br/>
                                    @if(($event->price)==0)
                                        <strong> free </strong>
                                    @else
                                        <strong>price</strong> <br/>
                                        <h3>{{ $event->price }}</h3>
                                    @endif

                                    <br/>
                                    @if(($event->seats)==0)

                                    @else
                                        <h3><strong>Available seats</strong></h3>

                                        {{ $event->seats }}
                                    @endif


                                </h4>

                            </div>
                        </div>
                        <hr>
                        <div class="row" id="description">
                            <div class="col-md-7">
                                @if((session()->get('show')))
                                    <div class="alert alert-success">
                                        <h4> {{session()->get('show')}}</h4>
                                    </div>

                                @endif
                                <h4><strong>Description</strong><br/><br/>
                                    <p>{{ $event->description }}
                                    </p>
                                </h4>
                                <br/>
                                <br/>
                                <h4><strong>Tags</strong></h4>
                                <br/>
                                <?php $tags = explode(",", $event->tags);?>
                                @foreach($tags as $tag)
                                    <a href="{{ URL::to('/searchTag/'. $tag)  }}">#{{ $tag }} &nbsp;</a>
                                @endforeach

                            </div>
                            <div class="col-md-5" id="require">
                                @if(($event->registration)=="required"  && $registration == [])

                                    <a href="{{ URL::to('register/'. $event->id) }}">
                                        <button class="btn btn-default" id="register" name="register" style="width:200px;">Register</button>
                                    </a>

                                @elseif($event->registration=="required" && $registration != [])


                                    <button class="btn btn-default" id="register" name="register" style="width:200px;">You are registerd.</button>
                                @else

                                    <a href="{{ URL::to('register/'. $event->id) }}">
                                        <button class="btn btn-default" id="register" name="register" style="width:200px;">Register</button>
                                    </a>

                                @endif
                                <br/>
                                <br/>
                                <h4><strong>Special requirements</strong><br/><br/>
                                    {{ $event->special_requirements }}
                                </h4>
                                <br/>
                                <br/>
                                <h4><strong>Category</strong>
                                    <br/>
                                    <br/>
                                    <?php $x = explode(",", $event->event_type) ?>
                                    @foreach( $x as $event_type)
                                        {{ $event_type }}
                                        <br/>
                                    @endforeach
                                </h4>
                                <br/>
                                <br/>

                                <a href="#" class="btn btn-info btn-lg" data-toggle="modal" data-target="#contactModal">
                                    <span class="fa fa-envelope-o"></span>&nbsp; Contact
                                </a>

                            </div>

                        </div>
                        <div class="row" id="map">
                            <div id="googleMap" style="width:100%;height:500px;"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">


        <div id="rsvp">

            <div id="rsvp_content">
                <div id="rsvp_data">

                    <h2>Going &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Not Going &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; May be </h2>
                    <h3> &nbsp; &nbsp; &nbsp; {{ $going }} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{ $notgoing }} &nbsp; &nbsp; &nbsp;
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{ $maybe }}</h3><br/>

                </div>
                <br/>
                <br/>

                <div id="rsvp_text">
                    &nbsp; Are you going?
                </div>
                <br/>

                <a href="#">
                    <div id="circle_yes">
                        yes

                    </div>
                </a>
                &nbsp; &nbsp; &nbsp; &nbsp;
                <a href="#">
                    <div id="circle_maybe">
                        may be

                    </div>
                </a>
                &nbsp; &nbsp; &nbsp; &nbsp;
                <a href="#">
                    <div id="circle_no">
                        no

                    </div>
                </a>

                <div id="rsvp-status">
                    {{ $aaa }}
                </div>
                <br/>
                <div class="row">
                    <span class="col-md-3">
                        <br/>
                        <br/>
                <a href="#" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">
                    <span class="glyphicon glyphicon-envelope"></span>&nbsp; Invite!
                </a>
                    </span>
                    <span class="col-md-9" id="share">
                    <p><h3>Share with your friends</h3>
                   &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; <span class="fb-share-button" data-href="https://github.com/puzzz21/eventeer" data-layout="button_count" data-size="large"
                                                          data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank"
                                                                                       href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fgithub.com%2Fpuzzz21%2Feventeer&amp;src=sdkpreparse">Share</a></span>
                        <br/>
                        &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="twitter-share-button"
                                                                       href="https://twitter.com/intent/tweet?text=Check out this event"
                                                                       data-size="large">
                            Tweet</a>
                       </p>
                    </span>


                </div>
            </div>
        </div>
    </div>
    <div id="disqus_thread"></div>
    <script>
        (function () {
            var d = document, s = d.createElement('script');
            s.src = '//eventeer.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>

@endsection
@section('script')
    <script id="dsq-count-scr" src="//eventeer.disqus.com/count.js" async></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0WD0EXUROBRkzi4cwJYZETuzDzBPQUgw&callback=initMap"></script>
    <script src="{{asset('js/jquery.datetimepicker.full.min.js')}}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        var address = "{{ $event->venue }}";
    </script>
    <script>window.twttr = (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0],
                    t = window.twttr || {};
            if (d.getElementById(id)) return t;
            js = d.createElement(s);
            js.id = id;
            js.src = "https://platform.twitter.com/widgets.js";
            fjs.parentNode.insertBefore(js, fjs);

            t._e = [];
            t.ready = function (f) {
                t._e.push(f);
            };

            return t;
        }(document, "script", "twitter-wjs"));</script>
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
        var routemail = '/email';
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
        $('#ticket').on('click', function () {
            $.ajax({
                url: '/ticket',
                method: 'get'
            });
        });
    </script>
    <script>
        $('#contactForm').on('click', function () {
            var name = $('#name').val();
            var address = $('#add').val();
            var msg = $('#msg').val();
            var id = $('#idd').val();
            $.ajax({
                url: '/emailOrganizer',
                method: 'GET',
                data: {
                    'name': name,
                    'address': address,
                    'msg': msg,
                    'id': id
                }
            });
        });
    </script>

    <script>
        $('#send_email').on('click', function () {
            var email = $("#email").val();

            $.ajax({
                url: '/email',
                method: 'get',
                data: {
                    'emails': email, 'urll': window.location.href, 'event_name': '{{ $event->event_name }}',
                    'event_venue': '{{ $event->venue }}', 'description': '{{ $event->description }}',
                    'event_start_datetime': '{{ $event->event_start_datetime }}',
                    'event_end_datetime': '{{ $event->event_end_datetime }}',
                    'logo': '{{ $event->logo }}',
                    'address': '{{ $event->address }}',
                    'city': '{{ $event->city }}',
                    'country': '{{ $event->country }}',
                    'event_type': '{{ $event->event_type }}',
                    'special_requirements': '{{ $event->special_requirements }}',
                    'price': '{{ $event->price }}',
                    'logo': '{{ $event->logo }}'
                }
            });
        });

    </script>

    <script>
        $('#grp li').click(function () {
            var text = $(this).text();
            $.ajax({
                url: '/emailList',
                method: 'get',
                data: {
                    'text': text
                }
            }).success(function (response) {
                var obj = JSON.parse(response);
                $('#email').val("adasd");
                var values = "Test,Prof,Off";
                $.each(values.split(","), function (i, e) {
                    $("#email option[value='" + e + "']").prop("selected", true);
                });

            });

        });
    </script>
@endsection