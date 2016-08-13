<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r"
          crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>
    <style>
        .btn {
            left: 40%;
            margin-right: -60%;
        }
    </style>

</head>
<body>
<div class="jumbotron text-center"><h2>Create profile</h2></div>
<form class="form-horizontal" role="form" method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label class="control-label col-sm-2" for="fname">name:</label>
        <div class="col-sm-4">
            <input type="text" name="name" size=10 placeholder="name" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="logo" class="col-sm-2 control-label">logo</label>
        <div class="col-md-4">
            <input name="logo" type="file" class="form-control"/>
        </div>
    </div>
    {{--<div class="form-group">--}}
        {{--<label class="control-label col-sm-2" for="uname">username:</label>--}}
        {{--<div class="col-sm-4">--}}
            {{--<input type="text" name="username" size=10 placeholder="username" class="form-control"/>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
        {{--<label class="control-label col-sm-2" for="uname">password:</label>--}}
        {{--<div class="col-sm-4">--}}
            {{--<input type="password" name="password" size=10 placeholder="password" class="form-control"/>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="form-group">
        <label class="control-label col-sm-2" for="address">address:</label>
        <div class="col-sm-4">
            <input type="text" name="address" size=10 placeholder="location" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="phone_number">contact number:</label>
        <div class="col-sm-4">
            <input type="text" name="phone_number" size=10 placeholder="contact number" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="interested_events">interested events:</label>
        <!-- <input type="text" name = "interested_events" size=10 placeholder="interested events" class="form-control"/> -->
        <div class="checkbox col-sm-4">
            <label><input type="checkbox" name="music"> music</label>
            <br/>
            <label><input type="checkbox" name="technology"> technology</label>
            <br/>
            <label><input type="checkbox" name="sports"> sports & wellness</label>
            <br/>
            <label><input type="checkbox" name="food">food & drinks</label>
            <br/>
            <label><input type="checkbox" name="arts">arts</label>
            <br/>
            <label><input type="checkbox" name="classes">classes</label>
            <br/>
            <label><input type="checkbox" name="parties">parties</label>
            <br/>
            <label><input type="checkbox" name="networking">networking</label>
            <br/>
            <label><input type="checkbox" name="causes">causes</label>
        </div>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" class="btn btn-success col-sm-1"/>
    </div>

</form>
</body>
</html>