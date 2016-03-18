<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
  public $fillable = ['name', 'slug'];

  public $timestamps = false;

  public function guilds()
  {
    return $this->hasMany(Guild::class);
  }

  public function characters()
  {
    return $this->hasMany(Character::class);
  }

}
