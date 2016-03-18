<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
  protected $fillable = ['name'];

  public function events()
  {
    return $this->hasMany(Event::class);
  }

  public function of()
  {
    return $this->morphTo('of');
  }
}
