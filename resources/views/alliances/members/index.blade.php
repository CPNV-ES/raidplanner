@extends('layouts.app')

@section('content')

    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            <img src="{{ $alliance->icon_path }}" alt="{{ $alliance->name }} logo">

            <div class="caption">
                <h3>Edit members for {{ $alliance->name }}</h3>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Rôle</th>
                        <th>Nom</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($alliance->guilds as $guild)

                        <tr>
                            <td>{{ $guild->alliance_role }}</td>
                            <td>{{ link_to_route('guilds.show', $guild->name, [$guild->id, 'subdomain' => $subdomain])}}</td>
                            <td>
                                @if ( $guild->alliance_role != 'master')
                                {{ Form::model($guild,['method'=>'PUT', 'route' => ['alliances.members.kick', $subdomain, $alliance->id]])}}
                                {{Form::hidden('guild_id', $guild->id)}}
                                {{ Form::submit('Kick', array('class' => 'btn btn-danger')) }}
                                {{ Form::close() }}
                                @else
                                    unable for master
                                @endif
                            </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>
                @if($guilds->isEmpty())
                    <h4>No guild found for adding</h4>
                @else
                    <h4>Add guild(s) to the alliance:</h4>
                    {{ Form::model($alliance,['method'=>'PUT', 'route' => ['alliances.members.add', $subdomain, $alliance->id]])}}
                    @foreach($guilds as $guild)
                        {{ Form::label($guild->id, $guild->name) }}
                        {{ Form::checkbox($guild->id, $guild->id) }}<br>
                    @endforeach
                    {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}
                    {{ Form::close() }}
                @endif

            </div>
        </div>
    </div>


@endsection



