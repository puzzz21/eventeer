@extends('layouts.app')
@section('style')
<style>
#regForm{
    margin-top:150px;
}
    .description{
        padding-top:25%;
        padding-bottom: 3rem;
       }
    .card{
        padding:25px;
        background:white;
    }
    body{
        height:100%;
        background:url("{{ URL::asset('images/o.jpg') }}") no-repeat center center fixed;
        -webkit-background-size:cover;
        -moz-background-size:cover;
        -o-backgound-size:cover;
        background-size:cover;
    }
</style>
<style type="text/css">
    @font-face {
        font-family: Roboto-Regular;
        src: url('{{ public_path('fonts/roboto/Roboto-Regular.tff') }}');
    }
</style>
@endsection
@section('content')

    <div class="container">
        <div class="row" id="regForm">
            <!--first column-->
            <div class="col-lg-6">
                <div class="description">
                    <h1 class="h1-responsive wow fadeInLeft" style="color:white;">Sign up right now</h1>
                    <hr class="hr-dark wow fadeInLeft">
                    <p class="wow fadeInLeft" data-wow-delay="0.4s" style="font-size:20px;color:white;">Connect to the events around you. Be subscribed to the events of your interest.</p>
                <br>

                </div>
            </div>

            <!--second column-->
            <div class="col-lg-6">

                    <div class="card wow fadeInRight">
                        <div class="card-block">

<center>
    <h3><i class="fa fa-user"></i> &nbsp; Register:</h3>
</center>


<hr>

                        <form class="form-horizontal"  role="form" method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}

                            <div class="md-form {{ $errors->has('name') ? ' has-error' : '' }}">
                               <i class="fa fa-user prefix"></i>
                                <label for="name">Name</label>


                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif

                            </div>
                            <br/>

                            <div class="md-form {{ $errors->has('email') ? ' has-error' : '' }}">
                               <i class="fa fa-envelope prefix"></i>
                                <label for="email">E-Mail Address</label>
                                 <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            <br/>

                            <div class="md-form {{ $errors->has('password') ? ' has-error' : '' }}">
                               <i class="fa fa-lock prefix"></i>
                                <label for="password" >Password</label>

                               <input id="password" type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                            </div>
                            <br/>

                            <div class="md-form {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <i class="fa fa-lock prefix"></i>

                                <label for="password-confirm" >Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                             </div>

                            <div class="text-xs-center">
                                    <button type="submit" class="btn btn-default">
                                      <h4> <i class="fa fa-btn fa-user"></i> Sign up</h4>
                                    </button>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>
               </div>
    </div>
@endsection
@section('script')
    <link rel="stylesheet" type="text/css" href="{{asset('css/jquery.datetimepicker.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/mdb.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('mdb.min.css')}}"/>
    <script src="{{asset('js/mdb.js')}}"></script>
    <script src="{{asset('js/mdb.min.js')}}"></script>
    <script src="{{asset('js/tether.js')}}"></script>
    <script src="{{asset('js/tether.min.js')}}"></script>

    @endsection
