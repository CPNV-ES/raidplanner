@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Users on this server :</div>

                <div class="panel-body">
                    <ul>
                        @foreach ($users as $user)
                            <li>{{ link_to_route('user.profiles.show', $user->username, ['subdomain' => $subdomain, $user->id]) }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
