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
    <p>First name : {{ $user->first_name }}</p>
    <p>Last name : {{ $user->last_name }}</p>
</div>
@endsection

