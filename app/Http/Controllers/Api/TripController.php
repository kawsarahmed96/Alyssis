<?php

namespace App\Http\Controllers\Api;

use App\Models\Trip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{

    public function index(Request $request)
    {
        $trips = Trip::latest()->select('destination', 'start_date', 'end_date', 'budget', 'notes')->get();
        if (!$trips || $trips->isEmpty()) {
            return response()->json([
                'message' => 'No trips found',
                'status' => false,
            ], 404);
        }

        return response()->json([
            'message' => 'Trips retrieved successfully',
            'status' => true,
            'data' => $trips
        ], 404);
    }


    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'destination' => 'required|string|max:255',
            'purpose' => 'required|exists:trip_perposes,id',
            'notes' => 'nullable|string|max:1000',
            'budget' => 'required|numeric|min:0',
        ]);


        $trip =  Trip::where('user_id', Auth::id())
            ->where([
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'destination' => $request->destination,
            ])->first();

        if ($trip) {
            return response()->json([
                'message' => 'Trip already exists for this user with the same start date, end date, and destination',
                'status' => false,
            ], 409);
        }

        try {
            $trip = Trip::create(
                [
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'destination' => $request->destination,
                    'purpose' => $request->purpose,
                    'notes' => $request->notes,
                    'budget' => $request->budget,
                    'user_id' => Auth::id(),
                ]
            );

            if (!$trip || empty($trip)) {
                return response()->json([
                    'message' => 'Trip not created',
                    'status' => false,
                ], 500);
            }

            return response()->json([
                'message' => 'Trip created successfully',
                'status' => true,
                'data' => $trip,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error in request',
                'status' => false,
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function update(Request $request) {

        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'destination' => 'nullable|string|max:255',
            'purpose' => 'nullable|exists:trip_perposes,id',
            'notes' => 'nullable|string|max:1000',
            'budget' => 'nullable|numeric|min:0',
        ]);

        $trip = Trip::find($request->id);
        if (!$trip) {
            return response()->json([
                'message' => 'Trip not found for update',
                'status' => false,
            ], 404);
        }

        if ($trip->user_id !== Auth::id()) {
            return response()->json([
                'message' => 'Unauthorized to update this trip',
                'status' => false,
            ], 403);
        }

        try {
            $trip->update($request->all());
            return response()->json([
                'message' => 'Trip updated successfully',
                'status' => true,
                'data' => $trip,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error in request',
                'status' => false,
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function destroy(Request $request)
    {

        $trip = Trip::find($request->id);
        if (!$trip) {
            return response()->json([
                'message' => 'Trip not found for deletion',
                'status' => false,
            ], 404);
        }

        if ($trip->user_id !== Auth::id()) {
            return response()->json([
                'message' => 'Unauthorized to delete this trip',
                'status' => false,
            ], 403);
        }

        try {
            $trip->delete();
            return response()->json([
                'message' => 'Trip deleted successfully',
                'status' => true,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error in request',
                'status' => false,
                'error' => $e->getMessage(),
            ], 400);
        }
    }
}
