<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomDays extends Model
{
   protected $fillable = [
        'task_type_id',
        'custom_day',

    ];


    protected $table ='custom_days';

}
