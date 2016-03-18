<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
  protected $fillable = ['name', 'icon_path'];

  public function group_members()
  {
    return $this->hasMany(GroupMember::class);
  }
}
