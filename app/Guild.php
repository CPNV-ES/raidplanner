<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guild extends Model
{
  protected $fillable = ['server_id', 'alliance_id', 'alliance_role', 'name', 'icon_path'];

  public function server()
  {
    return $this->belongsTo(Server::class);
  }

  public function alliance()
  {
    return $this->belongsTo(Server::class);
  }

}
