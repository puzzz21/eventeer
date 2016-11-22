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

        <div class="row">
            <center><p>
                <h3> Events you created</h3></p></center>
            @if($eventt==[])
                <center><p>no events created by you</p></center>


            @else
<center>
                <table class="table" style="width:50%;">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Events</th>
                        <th>Actions
                            <div id="gn"></div>
                        </th>
                    </tr>
                    </thead>
                    <tbody id="contact-table">
                    @foreach($eventt as $e)
                        <tr>
                            <td class="counterCell"></td>
                            <td><a href="{{ URL::to('events/'.$e->id) }}"> {{ $e->event_name }}</a></td>
                            <td>
                                <?php $id = $e->id; ?>
                                <input type="hidden" id="idVal" value="{{ $id }}"/>
                                <a class="teal-text" href=" {{ URL::to('/updateEvent/'. $id) }}"><i class="fa fa-pencil"></i></a>
                                <a class="red-text del" data-value="{{ $id }}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
</center>
        </div>
        <div class="row text-center">
            <br/>
            <hr>
            <br/>
            <center>
                <h3>Your upcoming events!!!</h3>
            </center>
            @if($going!=[])
                @foreach($going as $a)

                    <div class="col-md-3" id="thumb">


                        <div class="thumbnail">
                            <img src="{{ asset('public/upload/'.  $a->logo ) }}" style="width:400px;height:250px;"/>


                            <p><strong> {{ $a->event_name }} </strong></p>

                            <p>{{  $a->venue }}</p>
                            <p>{{ $a->event_start_datetime }}</p>
                            <a href="{{ URL::to('events/'.$a->event_id) }}">
                                <button class="btn btn-primary">Details...</button>
                            </a>

                        </div>
                    </div>

                @endforeach
            @else
                <p>
                <center>You don't have any upcoming events.</center></p>
            @endif


            <br/></div>
        <hr>
        <br/>
        <br/>


        <div class="row text-center">
            <center>
                <h3>Events you are might go!!!</h3>
            </center>
            <br/><br/>
            @if($maybe==[])
                <center>There no events you might go. <br/> <br/></center>
            @else
                @foreach($maybe as $a)


                    <div class="col-md-3" id="thumb">


                        <div class="thumbnail">
                            <img src="{{ asset('public/upload/'.  $a->logo ) }}" style="width:400px;height:250px;"/>


                            <p><strong> {{ $a->event_name }} </strong></p>

                            <p>{{  $a->venue }}</p>
                            <p>{{ $a->event_start_datetime }}</p>
                            <a href="{{ URL::to('events/'.$a->event_id) }}">
                                <button class="btn btn-primary">Details...</button>
                            </a>

                        </div>
                    </div>

                @endforeach
            @endif

        </div>
  @endsection
@section('script')
    <script>
        $('.del').on('click', function () {
            var that = $(this);
            var parent = that.parent().parent();

            $.ajax({
                url: 'deleteEvent',
                data: {'id': that.attr('data-value')}
            }).success(function (response) {
                if (response.success) {
                    parent.remove();
                    var table = $('#contact-table');
                    var grandparent = table.parent();

                    if (table.children().length == 0) {
                        grandparent.empty();

                        grandparent.append($('<div/>', {
                            class: 'form-group text-center',
                            html: 'No Groups available.'
                        }));
                    }
                }
            });
        });
    </script>
@endsection




