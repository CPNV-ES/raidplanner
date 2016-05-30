@extends('layouts.app')

@section('content')
<div id="error_section">
    @if (!empty("error"))
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
    {{ link_to_route('profile.edit', 'edit your profile', ['domain' => $subdomain]) }}
</div>
@endsection

