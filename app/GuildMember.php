<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuildMember extends Model
{
  protected $fillable = ['guild_id', 'user_id', 'role'];

  public function guild()
  {
    return $this->belongsTo(Guild::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function scopeof($query, $guild){
    return $query->where('guild_id', $guild->id);
  }
}
