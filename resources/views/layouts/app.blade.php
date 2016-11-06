<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta property="og:url"           content="http://localhost:9000/events/" />
        <meta property="og:type"          content="http://localhost:9000" />
        <meta property="og:title"         content="eventeer" />
        <meta property="og:description"   content="It is event based site" />
        {{--<meta property="og:image"         content="http://www.your-domain.com/path/image.jpg" />--}}


    <title>Eventeer</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <link href="{{asset('bower_components/paper-input/paper-input.html')}}" rel="import">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    @yield('style')
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
        li
        {
            list-style-type: none;
        }
        #info{
            background: #48C9B0;
            margin-top: 0px;
            padding: 10px;
            color: #FFFFFF;
            height: auto;
            font-size : 20px;

        }
        #description{
            height: auto;
            padding: 10px;
            font-size: 15px;

        }
        #event_name{
            font-size : 50px;
            width:100%;
            height:300px;
        }
        #event_info{
            font-size : 20px;
        }

        #bg{
            background-image : url("{{ URL::asset('images/a.jpg') }}");
            height:550px;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size:     cover;                      /* <------ */
            background-repeat:   no-repeat;
            font-size : 70px;
            padding-top: 200px;
            background-position: center;
            color:white;

        }
        #sec{
            font-size : 50px;
            margin:30px;
            height:400px;
            padding-top:50px;
        }
        #thumb{
            font-size : 20px;
            height:400px;
            padding-top:50px;
            width:450px;
        }

        #third{
            background-image : url("{{ URL::asset('images/ee.jpg') }}");
            height:500px;
            background-repeat: no-repeat;
            background-position: right top;
            background-attachment: fixed;
            background-size:     cover;                      /* <------ */
            background-repeat:   no-repeat;
            background-position: center center;
            font-size : 50px;
            padding-top: 200px;
            color: #ffffff;

        }

        #fourth{
            padding: 20px;
            font-size : 50px;

        }
        #fourth img{
            opacity: 0.5;

        }
        .center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 25px;
        }


        #create-event {
            position: relative;
            font-size: 15px;
        }
        #create-event:after {
            content : "";
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            background-image:  url("{{ URL::asset('images/red_latern.jpg') }}");
            width: 100%;
            height: 100%;
            opacity : 0.5;
            z-index: -1;

        }
        #form{
            background: transparent;
            margin:100px;
            margin-left:200px;
            margin-right:200px;
            padding : 50px;

        }

        #show_name{
            font-size: 50px;
            margin-top:400px;
            background-color: rgba(222,222,222,.7);

        }
        #show_desc
        {
            padding: 10px;
            margin:50px;
        }
        #req
        {
            color: #85929E;
        }
        #rsvp{
            background-image : url("{{ URL::asset('images/tree.jpg') }}");
            height: 600px;
           background-size:     cover;                      /* <------ */
            background-repeat:   no-repeat;
            background-position: center center;
            font: 30px;
            padding: 30px;
            margin-top:500px;


        }
        #rsvp_content{
            margin-left: 60%;
            color:#eceff1;

        }
        #rsvp_text{
            font-size:50px;
        }
        #circle_yes {
            width: 100px;
            height: 100px;
            background: #27AE60;
            -moz-border-radius: 50px;
            -webkit-border-radius: 50px;
            border-radius: 50px;
            text-align: center;
            font-size: 25px;
            display: inline-block;
            padding-top: 25px;

        }
        #circle_yes:hover {
            box-shadow: 0px 0px 10px 0px rgba(62, 69, 81, 0.8) ;
        }
        #circle_no {
            width: 100px;
            height: 100px;
            background: #F75353;
            -moz-border-radius: 50px;
            -webkit-border-radius: 50px;
            border-radius: 50px;
            text-align:center;
            font-size: 25px;
            display:inline-block;
            padding-top:25px;

        }
        #circle_no:hover {
            box-shadow: 0px 0px 10px 0px rgba(62, 69, 81, 0.8) ;
        }
        #circle_maybe {
            width: 100px;
            height: 100px;
            background: #F7A253;
            -moz-border-radius: 50px;
            -webkit-border-radius: 50px;
            border-radius: 50px;
            text-align:center;
            font-size: 25px;
            display:inline-block;
            padding-top:25px;

        }
        #circle_maybe:hover {
            box-shadow: 0px 0px 10px 0px rgba(62, 69, 81, 0.8) ;
        }

        #price{
            display: none;
        }
        #rsvp-status{
            color: #922B21;
            /*text-align:center;*/
            font-size: 20px;
            padding-top:10px;

        }
        #ticket{
            color:#eceff1;
        }
        .navbar{
            margin: 0px;
            padding:0px;
            /*background: rgba(76, 175, 80, 0);*/
        }
        /*.navbar.transparent.navbar-default .navbar-inner {*/
        /*background: rgba(0,0,0,0.4);*/
        /*font-size: 15px;*/

        /*}*/
        .navbar {
            border:0;
            font-size: 15px;
            padding:5px;
        }
        .navbar-brand{
            font-size: 15px;
        }
        .create{
            margin-top:80px;
        }

        #searchForm{
            color:#ffffff;
            font-size:50px;
        }
        #share{
            margin-left:0px;
            font-size:30px;

        }


    </style>

</head>
<body id="app-layout">
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<nav class="navbar navbar-default navbar-fixed-top" id="navbar">
    <div class="container-fluid">

        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                Eventeer
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/events') }}">Events</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li>
                        <a href="{{ route('events.create') }}">Create Event</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <img src="/images/uploads/avatar/{{ Auth::user()->avatar }}" class="img-circle" height=25px width=25px style="top:1px;"/>
                            <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/contacts') }}"><i class="fa fa-btn fa-envelope"></i>Contacts</a></li>
                            <li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-user"></i>Profile Setting</a></li>
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>


@yield('content')

        <!-- JavaScripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

@yield('script')
<link rel="stylesheet" type="text/css" href="{{asset('css/mdb.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('mdb.min.css')}}"/>
<script src="{{asset('js/mdb.js')}}"></script>
<script src="{{asset('js/mdb.min.js')}}"></script>
<script src="{{asset('js/tether.js')}}"></script>
<script src="{{asset('js/tether.min.js')}}"></script>
</body>
</html>
