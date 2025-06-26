<?php

namespace App\Http\Controllers\Api;

use App\Models\Days;
use App\Models\Task;
use App\Models\TaskType;
use App\Models\CustomDays;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tasks,name|string|max:255',
            'custom_day' => 'nullable|array',
            'day' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        if (Auth::user() === null) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
            ], 401);
        }

        $id = explode(',', $request->id[0])[0];
        $day = Days::find($id);

        if ($request->task_type === 'daily') {
            $task = Task::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
            ]);

            // Create the task type
            $task_type = TaskType::create([
                'task_id' => $task->id,
                'user_id' => Auth::user()->id,
                'task_type' => $request->task_type,
                'day' => null,
            ]);
        } else if ($request->task_type === 'weekly') {

            $task = Task::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
            ]);

            // Create the task type

            $task_type = TaskType::create([
                'task_id' => $task->id,
                'user_id' => Auth::user()->id,
                'task_type' => $request->task_type,
                'day' => $day->id,
            ]);
        } else if ($request->task_type === 'custom') {

            $task = Task::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
            ]);

            // Create the task type
            $task_type = TaskType::create([
                'task_id' => $task->id,
                'user_id' => Auth::user()->id,
                'task_type' => $request->task_type,
                'day' => null,
            ]);


            $id = explode(',', $request->id[0]);
            $days = Days::whereIn('id', $id)->get();

            foreach ($days as $custom_day) {
                CustomDays::create([
                    'task_type_id' => $task_type->id,
                    'user_id' => Auth::id(),
                    'custom_day' => $custom_day->id,
                ]);
            }
        }

        if (!$task) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to store task',
            ], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'Task stored successfully',
        ]);
    }


    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:tasks,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        if (Auth::user() === null) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
            ], 401);
        }

        // Delete the task
        $task = Task::find($request->id);
        if (!$task) {
            return response()->json([
                'status' => false,
                'message' => 'Task not found',
            ], 404);
        }

        $task->delete();

        return response()->json([
            'status' => true,
            'message' => 'Task deleted successfully',
        ]);
    }

    public function dayShow()
    {
        $days = Days::select('days')->get();
        if ($days->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No days found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Days retrieved successfully',
            'data' => $days,
        ]);
    }
}
