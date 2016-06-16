@extends('layouts.app')

@section('content')

  <div class="col-sm-12 col-md-12">
    <div class="thumbnail">
      <img src="{{ $guild->icon_path }}" alt="{{ $guild->name }} logo">

      <div class="caption">
        <h3 class="text-center">{{ $guild->name }}</h3>

        <p>
          @if(Role::haveRoleFor('guilds.quit', $user, $guild))
            {{ Form::open(['method' => 'PUT', 'route' => ['guilds.quit', $subdomain, $guild->id]]) }}
            {{ Form::submit('Quit guild', ['class' => 'btn btn-danger']) }}
            {{ Form::close() }}
          @endif

          @if(Role::haveRoleFor('guilds.edit', $user, $guild))
            {{link_to_route('guilds.edit', 'Modifier la guilde', ['subdomain' => $subdomain, $guild->id], ['class' => 'btn btn-default'])}}
          @endif

          @if(Role::haveRoleFor('guilds.destroy', $user, $guild))
            {{ Form::open(['method' => 'DELETE', 'route' => ['guilds.destroy',$subdomain, $guild->id]]) }}
            {{ Form::submit('Delete guild', ['class' => 'btn btn-danger']) }}
            {{ Form::close() }}
          @endif
        </p>

        @if ($guild->alliance_role == 'master')
          @if(Role::haveRoleFor('guilds.alliances.quit', $user, $guild))
            @if($guild->alliance_role != 'master')
              {{ Form::open(['method' => 'PUT', 'route' => ['guilds.alliances.quit',$subdomain, $guild->alliance->id, $guild->id]]) }}
              {{ Form::submit('Quit alliance', ['class' => 'btn btn-danger']) }}
              {{ Form::close() }}
            @else
              <p>You are master of the alliance, you can't quit them</p>
            @endif
          @endif
          <img src="http://dofus2.org/images/items/couronne-d-allister.png"
               alt="{{ $guild->name }} contrôle"/>
        @endif

        @if ($guild->alliance)
          <p>Fait partie de l'alliance:
            <b>{{ link_to_route('alliances.show', $guild->alliance->name, ['domain' => $subdomain, $guild->alliance->id]) }}</b>
          </p>
        @else
          <p>La guilde <b>{{ $guild->name }}</b> n'appartient à aucune alliance</p>
        @endif

        <div class="row">
          <div class="col-md-4">
            <h4>Calendriers :</h4>
            <ul class="list-group">
              @foreach($guild->calendars as $calendar)
                <li class="list-group-item">
                  {{ link_to_route('calendars.show', $calendar->name, ['domain'=>$subdomain,'calendars'=>$calendar] ) }}
                </li>
              @endforeach
            </ul>
          </div>
          <div class="col-md-8">
            <h4>Membres :</h4>
            <table class="table table-hover">
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
    </div>
  </div>

@endsection