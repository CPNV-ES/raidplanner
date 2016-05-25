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
                            <td>{{ $guild->name }}</td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>


@endsection



