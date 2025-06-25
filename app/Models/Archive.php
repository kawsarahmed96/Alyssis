<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    protected $fillable = [

        'user_id',
        'destination',
        'month',
        'years',
        'notes',
    ];


    public function images()
    {
        return $this->hasMany(ArchiveImage::class);
    }
}
