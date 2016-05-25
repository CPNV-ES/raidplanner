<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  // Fields
  protected $fillable = [
    'username',
    'email',
    'password',
    'firstname',
    'lastname',
    'birthday',
    'preferenced_server_id',
    'remember_token',
    'valid'
  ];

  // Relationships
  public function guild_members()
  {
    return $this->hasMany(GuildMember::class);
  }

  public function group_members()
  {
    return $this->hasMany(GroupMember::class);
  }

  public function groups()
  {
    return $this->belongsToMany(Group::class, 'group_members');
  }

  public function guilds(){
    return $this->belongsToMany(Guild::class, 'guild_members');
  }

  public function events()
  {
    return $this->hasManyThrough(Event::class, Subscribe::class);
  }

  public function subscribes()
  {
    return $this->hasMany(Subscribe::class, 'author_id');
  }

  public function preferenced_server()
  {
    //TODO: Vérifier si on doit préciser la foreign key (vu que différent) sinon modifier dans les autres models
    return $this->belongsTo(Server::class);
  }

  /**
   * TODO: Relations à faire :
   * - Serveurs ou je suis guildé
   * - Mes alliances
   */

  /**
   * TODO: Scope à faire :
   *  - mes futurs events
   *  - scoper à un serveur spécifique
   */

  public function scopememberOfGuild($query, $guild){
    return $query->getModel()->guild_members()->where('guild_id', $guild->id);
  }

  public function scopememberOfGroup($query, $group){
    return $query->getModel()->group_members()->where('group_id', $group->id);
  }
}
