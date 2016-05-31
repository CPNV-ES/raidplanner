@extends('layouts.app')

@section('content')
@foreach ($guilds as $guild)
     <div class="col-sm-12 col-md-3">
        <div class="thumbnail">
            <img src="{{ $guild->icon_path }}" alt="{{ $guild->name }} logo">

            <div class="caption">
                <h3>{{ $guild->name }}</h3>
                <p><a href="guilds/{{ $guild->id }}" class="btn btn-default" role="button">Voir
                    la guilde</a></p>
                <p><a href="guilds/{{ $guild->id }}/edit" class="btn btn-default" role="button">Modifier la guilde</a></p>

                {{ Form::open(['method' => 'DELETE', 'route' => ['guilds.destroy',$subdomain, $guild->id]]) }}
                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                {{ Form::close() }}

            </div>
        </div>

    </div>

@endforeach
<p><a href="guilds/create" class="btn btn-success" role="button">Créer une guilde</a></p>
@endsection