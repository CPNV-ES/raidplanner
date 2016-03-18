<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  protected $fillable = ['calendar_id', 'author_id', 'name', 'description'];

  public function calendar()
  {
    return $this->belongsTo(Calendar::class);
  }

  public function author()
  {
    return $this->belongsTo(User::class, 'author_id');
  }

  public function subscribes()
  {
    return $this->hasMany(Subscribe::class);
  }
}
