<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model implements \MaddHatter\LaravelFullcalendar\Event
{
  protected $fillable = ['calendar_id', 'author_id', 'name', 'description', 'start', 'end'];

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
    return $this->belongsToMany(User::class, 'subscribes','event_id','subscriber_id');
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
