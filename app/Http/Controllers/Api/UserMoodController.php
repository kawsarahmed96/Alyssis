<?php

namespace App\Http\Controllers\Api;

use App\Models\Mood;
use App\Models\Excelent;
use App\Models\UserMood;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserMoodController extends Controller
{

    public function index()
    {
        $userMoods = UserMood::with(['mood', 'excelent'])
            ->where('user_id', Auth::id())
            ->get();

        return response()->json([
            'status' => true,
            'data' => $userMoods,
        ], 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'icon' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'excelent_name' => 'required|string|unique:excelents,name|max:255',
            'thought' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $mood = Mood::create([
            'icon' => $request->icon,
            'name' => $request->name,
        ]);


        $explodeName =  explode(',', $request->excelent_name);

        foreach ($explodeName as $name) {
            Excelent::create([
                'name' => trim($name),
            ]);
        }

        // Create UserMood entries for each excelent name
        foreach ($explodeName as $excelent) {

            $name =  Excelent::where('name', $excelent)->each(function ($item) use ($mood, $request) {
                UserMood::create([
                    'user_id' => Auth::user()->id,
                    'mood_id' => $mood->id,
                    'excelent_id' => $item->id,
                    'thought' => $request->thought,

                ]);
            });
        }

        return response()->json([
            'status' => true,
            'message' => 'User mood created successfully',
        ], 201);
    }
}
