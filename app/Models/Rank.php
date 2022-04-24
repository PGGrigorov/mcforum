<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users() {
        return $this->belongsTo('App\Models\User');
    }

    public function user_ranks() {
        return $this->hasMany('App\Models\UserRank');
    }
}
