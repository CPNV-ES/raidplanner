@extends('layouts.app')

@section('content')

    <div class="col-md-6 col-md-offset-2">
        <h1>Create Alliance</h1>
        {{ Form::open(['route' => ['alliances.store', $subdomain]]) }}
            {{ Form::label('name', 'Name:') }}<br>
            {{ Form::text('name') }}<br><br>
            {{ Form::label('icon', 'Icon:') }}<br>
            {{ Form::text('icon path') }}<br><br>
            {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}
        {{ Form::close() }}
    </div>

@endsection



