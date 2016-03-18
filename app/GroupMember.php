<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
  protected $fillable = ['group_id', 'user_id', 'comment'];

  public function group()
  {
    return $this->belongsTo(Group::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}


