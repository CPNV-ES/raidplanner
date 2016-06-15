@extends('layouts.app')

@section('content')

    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            <img src="{{ $alliance->icon_path }}" alt="{{ $alliance->name }} logo">

            <div class="caption">
                <h3>{{ $alliance->name }}</h3>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Rôle</th>
                        <th>Blason</th>
                        <th>Nom</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($alliance->guilds as $guild)

                        <tr>
                            <td>{{ $guild->alliance_role }}</td>
                            <td><img src="{{ $guild->icon_path }}" alt="{{ $guild->name }} logo"></td>
                            <td>{{ link_to_route('guilds.show', $guild->name, [$guild->id, 'subdomain' => $subdomain])}}</td>
                        </tr>

                    @endforeach

                    @if($canEditMembers)
                        {{link_to_route('alliances.members.edit', 'Éditer les membres de l\'alliance', [$alliance->id, 'subdomain' => $subdomain], ['class' => 'btn btn-default'])}}
                    @endif

                    @if($canEdit)
                        {{link_to_route('alliances.edit', 'Éditer l\'alliance', [$alliance->id, 'subdomain' => $subdomain], ['class' => 'btn btn-default'])}}
                    @endif

                    @if($canDelete)
                        {{ Form::open(['method' => 'delete', 'route' => ['alliances.destroy', $subdomain, $alliance]]) }}
                        {{ Form::submit('Supprimer l\'alliance', ['class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                    @endif

                    @if($canQuit)
                        {{ Form::open(['method' => 'PUT', 'route' => ['alliances.quit', $subdomain, $alliance->id]]) }}
                        {{ Form::submit('Quitter l\'alliance', ['class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                    @endif


                    </tbody>
                </table>

            </div>
        </div>
    </div>


@endsection



