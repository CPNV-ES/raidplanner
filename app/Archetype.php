<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archetype extends Model
{
  protected $fillable = ['name'];

  public function characters()
  {
    return $this->hasMany(Character::class);
  }
}
