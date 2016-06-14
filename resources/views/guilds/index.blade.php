@extends('layouts.app')

@section('content')
@foreach ($guilds as $guild)
     <div class="col-sm-12 col-md-3">
        <div class="thumbnail">
            <img src="{{ $guild->icon_path }}" class="blason_guild" alt="{{ $guild->name }} logo">

            <div class="caption">
                <h3>{{ $guild->name }}</h3>
                <p>
                    <a href="guilds/{{ $guild->id }}" class="btn btn-default" role="button">Voir la guilde</a>
                </p>

            </div>
        </div>

    </div>

@endforeach

    @if ($canCreate)
        <p><a href="guilds/create" class="btn btn-success" role="button">Créer une guilde</a></p>
    @endif

@endsection