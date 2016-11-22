@extends('layouts.app')
@section('content')
    <br/>
    <br/>
    <br/>
    <br/>
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
           <center> <h3><strong>Registration information</strong></h3> </center>
            <br/>
            <br/>

    <form class="form-horizontal" role="form" method="POST" id="sub" action="{{ route('registerForm') }}" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <input type="hidden" name="event_id" id="i" value="{{ $id }}"/>
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"/>
        <input type="hidden" name="registration_no" value="{{ $id . Auth::user()->id . $id . Auth::user()->id}}"/>

        <div class="md-form">
            <label for="firstName">First Name</label>
            <input type="text" id="firstName" name="firstName" class="form-control" value="{{ old('first_name') }}" required="true">
        </div>
        <div class="md-form">
            <label for="lastName">Last Name</label>
            <input type="text" id="lastName" name="firstName" class="form-control" value="{{ old('last_name') }}" required="true">
        </div>
        <div class="md-form">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}" required="true">
        </div>
        <div class="md-form">
            <label for="cellPhone">Cell Phone</label>
            <input type="text" id="cellPhone" name="cellPhone" class="form-control" value="{{ old('cellPhone') }}" required="true">
        </div>

        <div class="md-form">
            <label for="age">Age </label>
            <input type="text" id="age" name="age" class="form-control" value="{{ old('age') }}" required="true">
        </div>

        <div class="form-group" style="margin-left:5px;">
            <label for="gender" id="fnt">Gender</label>

            <label><input type="radio" name="gender" value="male" style="margin-left:50px;"> male</label>
            <label><input type="radio" name="gender" value="female" style="margin-left:100px;"> female</label>
            <label><input type="radio" name="gender" value="other" style="margin-left:130px;"> other</label>


        </div>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <center><button type="submit" class="btn btn-default" value="Register" style="font-size:20px;">Register</button>

    </form>

    </div>
    </div>


@endsection
@section('script')
    <script>
        $('#sub').on('submit', function () {

            $.ajax({
                url: '/ticket',
                method: 'get'

            });


        });
    </script>
    @endsection
