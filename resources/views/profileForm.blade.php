@extends('layouts.app')
@section('style')
    <style>

        .hovereffect {
            width: 74%;
            height: 100%;
            float: left;
            overflow: hidden;
            position: relative;
            text-align: center;
            cursor: default;
        }

        .hovereffect .overlay {
            width: 80%;
            position: absolute;
            overflow: hidden;
            left: 0;
            top: auto;
            bottom: 0;
            padding: 1em;
            height: 7.75em;
            background: white;
            color: #3c4a50;
            -webkit-transition: -webkit-transform 0.35s;
            transition: transform 0.35s;
            -webkit-transform: translate3d(0, 100%, 0);
            transform: translate3d(0, 100%, 0);
        }

        .hovereffect img {
            display: block;
            position: relative;
            -webkit-transition: -webkit-transform 0.35s;
            transition: transform 0.35s;
        }

        .hovereffect:hover img {
            -webkit-transform: translate3d(0, -10%, 0);
            transform: translate3d(0, -10%, 0);
        }

        .hovereffect h2 {
            text-transform: uppercase;
            color: #fff;
            text-align: center;
            position: relative;
            font-size: 17px;
            padding: 10px;
            background: rgba(0, 0, 0, 0.6);
            float: left;
            margin: 0px;
            display: inline-block;
        }

        .hovereffect a.info {
            display: inline-block;
            text-decoration: none;
            padding: 7px 14px;
            text-transform: uppercase;
            color: #fff;
            border: 1px solid #fff;
            margin: 50px 0 0 0;
            background-color: transparent;
        }

        .hovereffect a.info:hover {
            box-shadow: 0 0 5px #fff;
        }

        .hovereffect p.icon-links a {
            float: right;
            color: #3c4a50;
            font-size: 1.4em;
        }

        .hovereffect:hover p.icon-links a:hover,
        .hovereffect:hover p.icon-links a:focus {
            color: #252d31;
        }

        .hovereffect h2,
        .hovereffect p.icon-links a {
            -webkit-transition: -webkit-transform 0.35s;
            transition: transform 0.35s;
            -webkit-transform: translate3d(0, 200%, 0);
            transform: translate3d(0, 200%, 0);
        }

        .hovereffect p.icon-links a span:before {
            display: inline-block;
            padding: 8px 10px;
            speak: none;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .hovereffect:hover .overlay,
        .hovereffect:hover h2,
        .hovereffect:hover p.icon-links a {
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        .hovereffect:hover h2 {
            -webkit-transition-delay: 0.05s;
            transition-delay: 0.05s;
        }

        .hovereffect:hover p.icon-links a:nth-child(3) {
            -webkit-transition-delay: 0.1s;
            transition-delay: 0.1s;
        }

        .hovereffect:hover p.icon-links a:nth-child(2) {
            -webkit-transition-delay: 0.15s;
            transition-delay: 0.15s;
        }

        .hovereffect:hover p.icon-links a:first-child {
            -webkit-transition-delay: 0.2s;
            transition-delay: 0.2s;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <div class="col-md-3 col-md-offset-1">
                <div class="row">
                    <div class="hovereffect">
                        <img src="/images/uploads/avatar/{{ auth()->user()->avatar }}" style="width:270px; height:270px;" class="img-rounded"/>

                        <div class="overlay">
                            <form id="frm" enctype="multipart/form-data" action="{{ route('avatar') }}" method="POST">
                                <input type="file" name="avatar">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-default" value="upload new picture">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <h2> {{ auth()->user()->name }}</h2>
                    <hr>
                    <div class="col-md-5">
                        <ul class="nav" role="tablist">



                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#profile" role="tab"><i class="fa fa-user"></i> Profile Setting</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#event" role="tab"><i class="fa  fa-cog"></i> Events Setting</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#password" role="tab"><i class="fa fa-lock"></i> Password</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#contact" role="tab"><i class="fa fa-envelope"></i> Contact</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#sync" role="tab"><i class="fa fa-calendar "></i> Sync</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 offset-md-2">
                <div class="tab-content">

                    <!--Panel 1-->
                    <div class="tab-pane fade in active" id="profile" role="tabpanel">
                        <br>

                        @if (isset($profile))
                            <form role="form" method="POST" id="sub" action="{{ route('profileUpdate') }}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                <input type="hidden" name="id" value="{{ $profile->id }}"/>
                                <h2>General Information</h2>
                                <br/>
                                <div class="md-form">
                                    <input type="text" value="{{ Auth::user()->name }}" name="name" class="form-control">
                                    <label for="name">Name</label>
                                </div>
                                <div class="md-form">
                                    <label for="About_you">About you</label>
                                    <textarea name="About_you" style="overflow-y: scroll;resize: none; height:120px" rows="7" class="md-textarea">{{ $profile->desciption }}</textarea>
                                </div>
                                <div class="md-form">
                                    <input type="text" name="contact" class="form-control" value="{{ $profile->contact }}">
                                    <label for="contact">Contact</label>
                                </div>

                                <input type="text" class="form-control" size="30" value="fields of your interests" name="categories" id="cat">

                                @if (isset($interestedEvents))
                                    <fieldset class="form-group" id="catChoices">
                                        <label><input type="checkbox" name="event_type" value="music" {{ !array_has($interestedEvents, 'music') ?: 'checked' }} id="c"> music</label>
                                        <br/>
                                        <label><input type="checkbox" name="event_type" value="technology" {{ !array_has($interestedEvents, 'technology') ?: 'checked' }} id="c"> technology</label>
                                        <br/>
                                        <label><input type="checkbox" name="event_type" value="sports & wellness" {{ !array_has($interestedEvents, 'sports & wellness') ?: 'checked' }} id="c"> sports & wellness</label>
                                        <br/>
                                        <label><input type="checkbox" name="event_type" value="food & drinks" {{ !array_has($interestedEvents, 'food & drinks') ?: 'checked' }} id="c">food & drinks</label>
                                        <br/>
                                        <label><input type="checkbox" name="event_type" value="arts" {{ !array_has($interestedEvents, 'arts') ?: 'checked' }} id="c">arts</label>
                                        <br/>
                                        <label><input type="checkbox" name="event_type" value="classes" {{ !array_has($interestedEvents, 'classes') ?: 'checked' }} id="c">classes</label>
                                        <br/>
                                        <label><input type="checkbox" name="event_type" value="parties" {{ !array_has($interestedEvents, 'parties') ?: 'checked' }} id="c">parties</label>
                                        <br/>
                                        <label><input type="checkbox" name="event_type" value="networking" {{ !array_has($interestedEvents, 'networking') ?: 'checked' }} id="c">networking</label>
                                        <br/>
                                        <label><input type="checkbox" name="event_type" value="causes" {{ !array_has($interestedEvents, 'causes') ?: 'checked' }} id="c">causes</label>
                                    </fieldset>
                                @else
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
                                @endif
                                <br/>
                                <h2>Home Address</h2>
                                <br/>
                                <div class="md-form">
                                    <input type="text" name="address" class="form-control" value="{{ $profile->address }}">
                                    <label for="address">Address</label>
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
                                            <select name="state" class="states" id="stateId">
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

                                <input type="hidden" name="checked[]" id="che" multiple="multiple">
                                <input type="submit" class="btn btn-default" value="update">
                            </form>

                        @else
                            <form role="form" method="POST" id="sub" action="{{ route('profileUpdate') }}" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                <h2>General Information</h2>
                                <br/>
                                <div class="md-form">
                                    <input type="text" value="{{ Auth::user()->name }}" name="name" class="form-control">
                                    <label for="name">Name</label>
                                </div>
                                <div class="md-form">
                                    <label for="About_you">About you</label>
                                    <textarea name="About_you" style="overflow-y: scroll;resize: none; height:120px" rows="7" class="md-textarea"></textarea>
                                </div>
                                <div class="md-form">
                                    <input type="text" name="contact" class="form-control">
                                    <label for="contact">Contact</label>
                                </div>

                                <input type="text" class="form-control" size="30" value="fields of your interests" name="categories" id="cat">

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
                                <hr>
                                <h2>Home Address</h2>

                                <div class="md-form">
                                    <input type="text" name="address" class="form-control">
                                    <label for="address">Address</label>
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

                                            <select name="state" class="states" id="stateId">
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

                                <input type="hidden" name="checked[]" id="che" multiple="multiple">
                                <input type="submit" class="btn btn-default" value="update">
                            </form>

                        @endif

                    </div>
                    <!--/.Panel 1-->

                    <!--Panel 2-->
                    <div class="tab-pane fade" id="event" role="tabpanel">
                        event
                        </div>
                        <!--/.Panel 2-->

                    <!--Panel 3-->
                    <div class="tab-pane fade" id="password" role="tabpanel">
                        <br>
                    <div id="rrr" class="alert alert-info"></div>
                        <div class="form">
                            <meta name="csrf-token" content="{{ csrf_token() }}" />

                            <div class="md-form">
                                <input type="password" name="current_pass" class="form-control" id="current">
                                <label for="address">Current password</label>
                            </div>
                            <div class="md-form">
                                <input type="password" name="new_pass" class="form-control" id="new">
                                <label for="address">New password</label>
                            </div>


                            <div class="md-form">
                                <input type="password" name="re_new_pass" class="form-control" id="re">
                                <label for="address">Re-type new password</label>
                            </div>
                            <button id="fff" class="btn btn-default">update!</button>
                        </div>
                        </div>
                    <!--/.Panel 3-->

                    <!--Panel 4-->
                    <div class="tab-pane fade" id="contact" role="tabpanel">
                        contact
                    </div>
                    <!--/.Panel 4-->

                    <!--Panel 5-->
                    <div class="tab-pane fade" id="sync" role="tabpanel">
                        sync
                    </div>
                    <!--/.Panel 5-->




                    </div>



            </div>
        </div>
        @endsection
        @section('script')
            <script src="{{ asset('js/password.js') }}"></script>
            <script src="http://iamrohit.in/lab/js/location.js"></script>
            <script>
                $("#catChoices").hide();
                $("#cat").click(function () {
                            $("#catChoices").slideToggle("slow");
                        }
                );
                $("#cat").keypress(function (event) {
                    event.preventDefault();
                });

            </script>
            <script type="text/javascript">
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            </script>
@endsection