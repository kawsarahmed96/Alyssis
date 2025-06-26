<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMood extends Model
{
    protected $fillable = [
        'user_id',
        'mood_id',
        'excelent_id',
        'thought',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   public function mood()
    {
        return $this->belongsTo(Mood::class);
    }

    public function excelent()
    {
        return $this->belongsTo(Excelent::class);
    }
}
