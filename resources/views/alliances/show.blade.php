@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="col-sm-6 col-md-6">
      <div class="thumbnail">
        <img src="{{ $alliance->icon_path }}" alt="{{ $alliance->name }} logo">

        <div class="caption">
          <h3>{{ $alliance->name }}</h3>

          <table class="table table-striped">
            <tbody>

            @foreach($alliance->guilds as $guild)

              <tr>
                <td><img style="margin-right: 10px; max-height: 25px;" src="{{ $guild->icon_path }}" alt="{{ $guild->name }} logo"> {{ link_to_route('guilds.show', $guild->name, [$guild->id, 'subdomain' => $subdomain])}}</td>
                <td class="text-right">{{ $guild->alliance_role }}</td>
              </tr>

            @endforeach

            @if($canEditMembers)
              {{link_to_route('alliances.members.edit', 'Edit members of the alliance', [$alliance->id, 'subdomain' => $subdomain], ['class' => 'btn btn-default'])}}
            @endif

            @if($canEdit)
              {{link_to_route('alliances.edit', 'Edit the alliance', [$alliance->id, 'subdomain' => $subdomain], ['class' => 'btn btn-default'])}}
            @endif

            @if($canDelete)
              {{ Form::open(['method' => 'delete', 'route' => ['alliances.destroy', $subdomain, $alliance]]) }}
              {{ Form::submit('Delete the alliance', ['class' => 'btn btn-danger']) }}
              {{ Form::close() }}
            @endif

            @if($canQuit)
              {{ Form::open(['method' => 'PUT', 'route' => ['alliances.quit', $subdomain, $alliance->id]]) }}
              {{ Form::submit('Quit the alliance', ['class' => 'btn btn-danger']) }}
              {{ Form::close() }}
            @endif


            </tbody>
          </table>

        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-6">
      <h4>Calendriers :</h4>
      <ul class="list-group">
        @foreach($alliance->calendars as $calendar)
          <li class="list-group-item">
            {{ link_to_route('calendars.show', $calendar->name, ['domain'=>$subdomain,'calendars'=>$calendar] ) }}
          </li>
        @endforeach
      </ul>
    </div>
  </div>

@endsection



