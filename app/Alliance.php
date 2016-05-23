<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alliance extends Model
{
  protected $fillable = ['name', 'icon_path'];

  public function guilds()
  {
    return $this->hasMany(Guild::class);
  }
  public function servers()
  {
    return $this->belongsToMany(Server::class, 'guilds');
  }
}
