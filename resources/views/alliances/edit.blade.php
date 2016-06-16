@extends('layouts.app')

@section('content')


    <h1>Edition of the alliance {{$alliance->name}}</h1>

    {{ Form::model($alliance,['method'=>'PUT', 'route' => ['alliances.update', $subdomain, $alliance->id]])}}

            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name') }}<br>

            {{ Form::label('icon', 'Icon:') }}
            {{ Form::text('icon path') }}<br>

            {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}

    {{ Form::close() }}


@endsection



