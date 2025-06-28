<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $fillable = ['user_id', 'description', 'icon', 'related_task_id', 'notification_time', 'is_read'];
}
