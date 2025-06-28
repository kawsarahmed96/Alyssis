<?php

namespace App\Http\Controllers\Api;

use App\Models\TripPerpose;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TripPerposeController extends Controller
{
    public function index()
    {
      
        $trip_perposes = TripPerpose::select('purpose')
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'status' => 200,
            'message' => 'Trip purposes retrieved successfully',
            'data' => $trip_perposes,
        ]);
    }

    //trip perpose store
    public function store(Request $request)
    {
        // Validate the request data

        $validator = Validator::make($request->all(), [
            'purpose' => 'required|string|max:255|unique:trip_perposes,purpose',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $trip_perpose = new TripPerpose();
            $trip_perpose->purpose = $request->purpose;
            $trip_perpose->save();

            return response()->json([
                'status' => 201,
                'message' => 'Trip purpose created successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error in request',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    //trip perpose delete

    public function destroy(Request $request)
    {
        $trip_perpose = TripPerpose::find($request->id);
        if ($trip_perpose) {
            $trip_perpose->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Trip purpose deleted successfully',
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => 'Trip purpose not found',
        ]);
    }
}
