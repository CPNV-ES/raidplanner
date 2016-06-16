@extends('calendars.layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2>Calendrier de "{{$calendar->of->name}}"</h2>
        {!! $full_calendar->calendar() !!}
      </div>
    </div>
  </div>
@endsection

@section('script')
  @parent
  {!! $full_calendar->script() !!}
@endsection