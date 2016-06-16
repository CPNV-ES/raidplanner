@extends('layouts.app')

@section('style')
  @parent
  <link rel="stylesheet" media="all" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.7.3/fullcalendar.min.css"/>
  <link rel="stylesheet" media="all" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.7.3/fullcalendar.print.css"/>
@endsection

@section('script')
  @parent
  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
@endsection