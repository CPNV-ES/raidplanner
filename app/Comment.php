<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['author_id', 'message'];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function target()
    {
        return $this->morphTo('target');
    }

}