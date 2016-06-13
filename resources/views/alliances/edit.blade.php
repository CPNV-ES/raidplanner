@extends('layouts.app')

@section('content')


    <h1>Edition de l'alliance {{$alliance->name}}</h1>

    {{ Form::model($alliance,['method'=>'PUT', 'route' => ['alliances.update', $subdomain, $alliance->id]])}}

            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name') }}<br>

            {{ Form::label('icon', 'Icon:') }}
            {{ Form::text('icon path') }}<br>

            @foreach($guilds as $guild)

                {{ Form::label($guild->name, $guild->name) }}
                {{ Form::checkbox($guild->name, $guild->id) }}<br>

            @endforeach


            {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}

    {{ Form::close() }}


@endsection



