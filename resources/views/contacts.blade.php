@extends('layouts.app')
<style>
table {
counter-reset: tableCount;
}
.counterCell:before {
content: counter(tableCount);
counter-increment: tableCount;
}
</style>

@section('content')
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <div class="container">
        <center><h1>Contact group</h1></center>
        <hr>
        <br/>
<div id="first">
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="contactModal">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content" id="contents">

            </div>
        </div>
    </div>
    <center>
        <button class="btn btn-default" id="create" style="height:50px;font-size:20px;background:#3E4551;color:white;">Create group</button>
        <form class="form" id="group" style="width:50%;"   enctype="multipart/form-data">
            <div class="card">
                <center>
                    <br/>
                    <br/>
                    <div class="md-form" style="width:50%;">
                        <label for="group_name">Group name</label>
                        <input type="text" name="group_name" id="group_name"/>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    {!! csrf_field() !!}
                    {{--<button class="btn btn-default" onClick="getContacts();">Add contacts</button>--}}
                    <button type="submit" class="btn btn-default" value="ok!">ok!</button>
                </center>
            </div>

        </form>
        <br/>
        <br/>
        <br/>
        <br/>
        <div id="gn"></div>
        @if (isset($group_name[0]))
            <table class="table" style="width:50%;">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Group Name</th>
                   <th>Actions <div id="gn"></div></th>
                </tr>
                </thead>
                <tbody id="contact-table">
                @foreach($group_name as $grp)
                <tr>
                    <td class="counterCell"></td>
                    <td>{{ $grp->group_name }}</td>
                    <td>
                         {{--href=" {{ URL::to('/deleteGrp/'.  $grp->id)  }}"--}}
                        <a class="teal-text" href=" {{ URL::to('/updategroup/'. $grp->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="red-text del" data-value="{{ $grp->id }}"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>



        @else
        <div class="form-group text-center">No Groups available.</div>
        @endif
        <div id="fff"></div>
    </center>
</div>
    {{--<div id="second">--}}
            {{--<a href="#" id="back">group list</a> > edit page--}}

        {{--<form class="form" id="group-update" style="width:50%;"  enctype="multipart/form-data">--}}

                {{--<center>--}}
                    {{--<input type="hidden" name="group_id" id="group_id"/>--}}

                    {{--<div class="md-form" style="width:50%;">--}}
                        {{--<label for="group_name">Group name</label>--}}
                        {{--<input type="text" name="group_name" id="group_name"/>--}}


                    {{--</div>--}}
                    {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                    {{--{!! csrf_field() !!}--}}
                    {{--<button class="btn btn-default" onClick="getContacts();">Add contacts</button>--}}
                    {{--<input type="submit" class="btn btn-default" value="ok!"></input>--}}
                {{--</center>--}}
        {{--</form>--}}


    {{--</div>--}}
    </div>



@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('js/oauth.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/contacts.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#group').hide();

            $('#create').on('click', function () {
                $('#group').slideToggle('500');

            });
            {{--$('#second').hide();--}}
            {{--$('#edit').on('click',function(){--}}
               {{--$('#first').hide();--}}
                {{--$('#second').show();--}}
                {{--$('$group_name').text( '{{ $grp->group_name }}');--}}

            {{--});--}}
            {{--$('#back').on('click',function(){--}}
                {{--$('#first').show();--}}
                {{--$('#second').hide();--}}

            {{--});--}}
        });
    </script>

    <script src="https://apis.google.com/js/client.js?onload=onLoadCallback"></script>
    <script>
        function onLoadCallback() {
            gapi.client.setApiKey('362726803932-tpcg7bd2cqq0cc8bc2a2lpji6tptudo7.apps.googleusercontent.com');

        }
    </script>
@endsection