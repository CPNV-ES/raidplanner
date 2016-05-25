@extends('layouts.app')

@section('content')

    <h1>Create Alliance</h1>

    {{ Form::open(['route' => 'alliances.store']) }}
    <ul>

        <li>
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name') }}
        </li>

        <li>
            {{ Form::label('icon', 'Icon:') }}
            {{ Form::text('icon path') }}
        </li>

        <li>
            {{ Form::submit('Submit', array('class' => 'btn')) }}
        </li>
    </ul>
    {{ Form::close() }}


@endsection



