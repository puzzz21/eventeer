@extends('layouts.app')
<style>
    table {
        counter-reset: tableCount;
    }

    .counterCell:before {
        content: counter(tableCount);
        counter-increment: tableCount;
    }

    .modal-body {
        width: 350px;
        height: 400px;
        overflow: scroll;
    }
    .modal-content{
        width: 350px;

    }
</style>
@section('content')
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <div class="container">
       <h4> <a href=" {{ URL::to('contacts') }}" id="back">group list</a> > edit page </h4>
        <br/>
        <br/>
        <h1><center>Contact list</center></h1>
        <hr>
        @if(isset($success))
            <div class="alert alert-success fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> The group name is updated.
            </div>
        @endif
        <div id="first">
            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="contactModal">
                <div class="modal-dialog modal-sm" role="document">

                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Your Gmail contacts</h4>
                        </div>
                        <div class="modal-body" id="contents">

                        </div>
                        <div class="modal-footer">
                            <form class="form-horizontal" id="emailForm" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"/>
                                    <input type="hidden" name="selectedEmails[]" id="selectedEmails"/>
                                    <input type="hidden" name="groupID" id="groupID"/>
                                    <input type="hidden" name="groupNAME" id="groupNAME"/>
                                    <button type="submit" name="submit" class="btn btn-primary" id="add" value="Add">Add</button>
                                    {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}

                                </form>

                         </div>
                    </div>

                </div>
            </div>
        </div>
<br/>


<center>
        @if(isset($group))
            @foreach ($group as $grp)
                <form class="form-inline" id="group-update" action="{{ route('updateGrp') }}" style="width:50%;" enctype="multipart/form-data" role="form">

                        <input type="hidden" name="group_id" id="group_id" value="{{ $grp->id }}"/>
                        <div class="md-form" style="width:50%;">
                            <label for="group_name">Group name</label>
                            <input type="text" name="group_name" id="group_name" placeholder="{{ $group_name}}"/>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        {!! csrf_field() !!}
                        <button type="submit" id="update" class="btn btn-default" value="update">update</button>

                </form>
            @endforeach
        @else
            <form class="form-inline" id="group-update" action="{{ route('updateGrp') }}" style="width:50%;" enctype="multipart/form-data" role="form">

                    <input type="hidden" name="group_id" id="group_id" value="{{ $group_id }}"/>
                    <div class="md-form" style="width:50%;">
                        <label for="group_name">Group name</label>
                        <input type="text" name="group_name" id="group_name" value="{{ $group_name }}" placeholder="{{ $group_name }}"/>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    {!! csrf_field() !!}
                    <button type="submit" id="update" class="btn btn-default" value="update" >update</button>

            </form>
        @endif
</center>
        <br/>
<hr>
        <br/>
        <br/>
        <br/>
<div class="row">
    <div class="col-md-10">
        <center>
        @if(empty($l))
            <p>No contacts</p>

            @else

            <table class="table" style="width:80%;">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Email address</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($l as $email)

                    <tr>
                        <td class="counterCell"></td>
                        <td>{{ $email }}</td>
                        <td>


                            {{--"{{ url('sig/edit/ ' . $value->id . '/' . $value->ticketid }}"--}}
                            {{--<a class="teal-text" href=" {{ URL::to('/updategroup/'. $grp->id) }}"><i class="fa fa-pencil"></i></a>--}}

                            <a class="red-text" href=" {{ URL::to('/deleteGroup/'.  $email . '/' . $group_id . '/' . $group_name)  }}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

        @endif
        </center>
    </div>
    <div class="col-md-2">
        <br/>
        <center>
            <button class="btn btn-primary" onClick="getContacts();" style="height:50px;font-size:20px;background:#3E4551;color:white;">Add contacts</button>
        </center>
    </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('js/oauth.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/contacts.js') }}"></script>

    <script src="https://apis.google.com/js/client.js?onload=onLoadCallback"></script>
    <script>
        function onLoadCallback() {
            gapi.client.setApiKey('362726803932-tpcg7bd2cqq0cc8bc2a2lpji6tptudo7.apps.googleusercontent.com');

        }
    </script>

@endsection