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
        <input type="hidden" name="event_id" value="{{ $id }}"/>
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"/>

        <div class="md-form">
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name') }}" required="true">
        </div>
        <div class="md-form">
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name') }}" required="true">
        </div>
        <div class="md-form">
            <label for="title">Event Title</label>
            <input type="text" id="title" name="event_name" class="form-control" value="{{ old('event_name') }}" required="true">
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

        <div class="md-form">
            <label for="gender" id="fnt">gender</label>
            <label><input type="radio" name="gender" value="male" id="gender" style="margin-left:200px;"> male</label>
            <label><input type="radio" name="gender" value="female" id="gender" style="margin-left:100px;"> female</label>
            <label><input type="radio" name="gender" value="other" id="gender" style="margin-left:300px;">other</label>
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
