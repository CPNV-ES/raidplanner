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
        return $this->belongsTo(Alliance::class);
    }

    public function usersByRole($role){
        return $this->belongsToMany(User::class, 'guild_members')->wherePivot('role', $role);
    }

}
