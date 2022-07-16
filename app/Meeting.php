<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = ['title', 'description', 'time'];

    public function users()
    {
        $this->belongsToMany(User::class);
    }
}
