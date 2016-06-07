@extends('layouts.app')

@section('content')

    <div class="row center-block">

        @foreach($alliances as $alliance)

            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="{{ $alliance->icon_path }}" alt="{{ $alliance->name }} logo">

                    <div class="caption">
                        <h3>{{ $alliance->name }}</h3>

                        {{link_to_route('alliances.show', 'Voir l\'alliance', [$alliance->id, 'subdomain' => $subdomain], ['class' => 'btn btn-default'])}}
                    </div>
                </div>
            </div>

        @endforeach

        {{link_to_route('alliances.create', 'Créer une alliance', ['subdomain' => $subdomain], ['class' => 'btn btn-success'])}}

    </div>

@endsection