@extends('layouts.app')

@section('content')

    <div class="col-sm-12 col-md-12">
        <div class="thumbnail">
            <img src="{{ $guild->icon_path }}" alt="{{ $guild->name }} logo">

            <div class="caption">
                <h3 class="text-center">{{ $guild->name }}</h3>

                @if ($guild->alliance_role === 'master')
                    <img src="http://dofus2.org/images/items/couronne-d-allister.png"
                         alt="{{ $guild->name }} contrôle"/>
                @endif

                @if ($guild->alliance)
                    <p>Fait partie de l'alliance: <b>{{ link_to_route('alliances.show', $guild->alliance->name, ['domain' => $subdomain, $guild->alliance->id]) }}</b></p>
                @else
                    <p>La guilde <b>{{ $guild->name }}</b> n'appartient à aucune alliance</p>
                @endif

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Role</th>
                    </tr>
                    </thead>
                    @foreach($guild->members as $member)
                    <tr>
                        <td>{{ link_to_route('user.profiles.show', $member->username, ['domain' => $subdomain, $member->id]) }}</td>
                        <td>{{$member->pivot->role}}</td>
                    </tr>
                    @endforeach

                </table>

            </div>
        </div>
    </div>

@endsection