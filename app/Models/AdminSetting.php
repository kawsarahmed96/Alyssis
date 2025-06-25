<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{
   protected $fillable = [
        'title',
        'email',
        'logo',
        'favicon',
        'copyright',
        'hotline',
    ];
}
