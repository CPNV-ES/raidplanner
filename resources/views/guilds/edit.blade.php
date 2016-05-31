@extends('layouts.app')

@section('content')
    <div class="col-md-4">
        <h1>Modifier la guilde:</br> {{ $guild->name }}</h1>
        {!! Form::model($guild,['method' => 'PATCH', 'route' => ['guilds.update', $subdomain, $guild->id]]) !!}
        <div class="form-group">
            {!! Form::label('Name', 'Nom:') !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Icon', 'Icon:') !!}
            {!! Form::text('icon_path',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection