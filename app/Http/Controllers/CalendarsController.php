<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use FullCalendar;
use App\Calendar;

use App\Http\Requests;

class CalendarsController extends DomainController
{
  public function show(Request $request)
  {
    $calendar = Calendar::findOrFail($request->calendars);
    $full_calendar = FullCalendar::addEvents($calendar->events);
    return view('calendars.show', compact('calendar', 'full_calendar'));
  }

  public function destroy(Request $request){
    Calendar::destroy($request->id);
  }
}
