<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
  public $fillable = ['user_id', 'event_id', 'comment'];

  public function subscriber()
  {
    return $this->belongsTo(User::class);
  }

  public function event()
  {
    return $this->belongsTo(Event::class);
  }
}
