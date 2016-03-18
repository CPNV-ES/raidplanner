<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
  protected $fillable = ['user_id', 'server_id', 'archetype', 'name', 'level', 'main', 'description'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function server()
  {
    return $this->belongsTo(User::class);
  }

  public function archetype()
  {
    return $this->belongsTo(Archetype::class);
  }
}
