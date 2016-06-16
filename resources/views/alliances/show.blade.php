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


              <!-- -TO DO: Ajouter les conditions pour afficher les boutons selon le paramètre qui sera passé dans le controlleur -->
            @if($canEdit)
              {{link_to_route('alliances.edit', 'Éditer l\'alliance', [$alliance->id, 'subdomain' => $subdomain], ['class' => 'btn btn-default'])}}
            @endif

            @if($canDelete)
              {{ Form::open(['method' => 'delete', 'route' => ['alliances.destroy', $subdomain, $alliance]]) }}
              {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
              {{ Form::close() }}
            @endif

          </tbody>
        </table>

      </div>
    </div>
  </div>

  <div class="col-sm-6 col-md-4">
      <h4>Calendriers :</h4>
      <ul class="list-group">
        @foreach($alliance->calendars as $calendar)
          <li class="list-group-item">
            {{ link_to_route('calendars.show', $calendar->name, ['domain'=>$subdomain,'calendars'=>$calendar] ) }}
          </li>
        @endforeach
      </ul>
  </div>


@endsection



