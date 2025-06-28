<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function NotificationStore(Request $request)
    {

        $validator  = Validator::make($request->all(), [
            'user_id' => 'required',
            'description' => 'required',
            'icon' => 'required',
            'related_task_id' => 'required',
            'notification_time' => 'required',
            'is_read' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        Notification::cretate([
            'user_id' => Auth::id(),
            'description' => $request->description,
            'icon' => $request->icon,
            'related_task_id' => $request->related_task_id,
            'notification_time' => Carbon::now(),
            'is_read' => false
        ]);
    }
}
