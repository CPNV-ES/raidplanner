@extends('layouts.errors')

@section('title')

    <title>{{$code}}</title>

@endsection

@section('content')

<div class="title">
    <h1>{{$code}}</h1>
</div>

<div class="content">
    <p>{{$message}}</p>
</div>

@endsection