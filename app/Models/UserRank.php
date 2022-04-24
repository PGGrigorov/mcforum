<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRank extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users() {
        return $this->hasMany('App\Models\User');
    }

    public function ranks() {
        return $this->belongsTo('App\Models\Rank');
    }



}
