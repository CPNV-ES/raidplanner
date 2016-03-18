<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
  protected $fillable = ['user_id', 'target_id', 'from_id', 'target_type', 'reason'];

  public function target()
  {
    return $this->belongsTo(User::class);
  }

  public function author()
  {
    return $this->belongsTo(User::class);
  }

  public function from()
  {
    return $this->morphTo('from');
  }
}
