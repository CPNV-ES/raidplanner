<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \MaddHatter\LaravelFullcalendar\Event as FullCalendarEvent;

class Event extends Model implements FullCalendarEvent
{
  protected $fillable = ['calendar_id', 'author_id', 'name', 'description'];

  protected $dates = ['start', 'end'];

  public function calendar()
  {
    return $this->belongsTo(Calendar::class);
  }

  public function author()
  {
    return $this->belongsTo(User::class);
  }

  public function subscribes()
  {
    return $this->hasMany(Subscribe::class);
  }

  public function subscribers()
  {
    return $this->belongsToMany(User::class, 'subscribes');
  }

  public function getId()
  {
    return $this->id;
  }

  public function getTitle()
  {
    return $this->name;
  }

  public function isAllDay()
  {
    return false;
  }

  public function getStart()
  {
    return $this->start;
  }

  public function getEnd()
  {
    return $this->end;
  }
}

// TODO: revoir les relations
