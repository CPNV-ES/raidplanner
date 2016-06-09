@extends('layouts.app')

@section('content')
<div id="error_section">
    @if (isset($error) && !empty($error))
        <span class="help-block">
            <strong>{{ $error }}</strong>
        </span>
    @endif
</div>
<div class="container">
    <p>Username : {{ $user->username }}</p>
    <p>Email : {{ $user->email }}</p>
    <p>First name : {{ $user->firstname }}</p>
    <p>Last name : {{ $user->lastname }}</p>
    @if ($guild != null)
        <p>Guild sur {{title_case($subdomain)}} : {{link_to_route('guilds.show', $guild->name, ['domain' => $subdomain, $guild->id])}}</p>
    @endif
    @if (isset($editable))
        {{ link_to_route('profile.edit', 'edit your profile', ['domain' => $subdomain]) }}
    @endif
</div>
@endsection

