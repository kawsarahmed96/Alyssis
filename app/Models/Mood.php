<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mood extends Model
{
    protected $fillable = [
        'icon',
        'name',
    ];

    public function userMoods()
    {
        return $this->hasMany(UserMood::class);
    }

    public function excelents()
    {
        return $this->hasMany(Excelent::class);
    }
}
