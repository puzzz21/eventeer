@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="form-group">
                <label for="" class="form-control">{{ $profile->id }}</label>
            </div>
            <div class="form-group">
                <label for="" class="form-control">{{ $profile->name }}</label>
            </div>
            <div class="form-group">
                <label for="" class="form-control">{{ $profile->address }}</label>
            </div>
            <div class="form-group">
                <label for="" class="form-control">{{ $profile->phone_number }}</label>
            </div>
        </div>
    </div>
@stop