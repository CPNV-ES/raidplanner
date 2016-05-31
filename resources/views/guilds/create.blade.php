@extends('layouts.app')

@section('content')
    <div class="col-md-4">
        <h1>Créer une guilde</h1>

        {!! Form::open(['route' => ['guilds.store', $subdomain]]) !!}

        <div class="form-group">
            {!! Form::label('name', 'Nom:') !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('icon', 'Icon:') !!}
            {!! Form::text('icon_path',null,['class'=>'form-control']) !!}
        </div>
       <div class="form-group">
            {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
            {!! Form::close() !!}
    </div>

@endsection