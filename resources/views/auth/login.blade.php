@extends('layouts.app')
<style>
    #regForm {
        margin-top: 150px;
    }

    .description {
        padding-top: 25%;
        padding-bottom: 3rem;
    }

    .card {
        padding: 25px;
        background: white;
    }

    body {
        height: 100%;
        background: url("{{ URL::asset('images/uu.jpg') }}") no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-backgound-size: cover;
        background-size: cover;
    }
</style>
<style type="text/css">
    @font-face {
        font-family: Roboto-Regular;
        src: url('{{ public_path('fonts/roboto/Roboto-Regular.tff') }}');
    }
</style>
@section('content')
    <div class="container">
        <div class="row" id="regForm">
            <div class="col-lg-6">

            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-block">
                        <center>
                            <h3><i class="fa fa-user"></i> &nbsp; Login:</h3>
                        </center>


                        <hr>
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}

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

                            <div class="md-form{{ $errors->has('password') ? ' has-error' : '' }}">
                                <i class="fa fa-lock prefix"></i>
                                <label for="password">Password</label>


                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-default">
                                        <h4><i class="fa fa-btn fa-sign-in"></i> Login</h4>
                                    </button>
                                    <br/>
                                    <br/> <a href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                                </div>
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

