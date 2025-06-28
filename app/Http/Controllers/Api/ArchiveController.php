<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Archive;
use App\Models\ArchiveImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $all_archive = Archive::with('images')->get();
        if ($all_archive->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No archives found',
            ], 404);
        }
        return response()->json([
            'status' => true,
            'message' => 'All archives retrieved successfully',
            'data' => $all_archive,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = validator::make($request->all(), [
            'destination' => 'required|string|max:255',
            'month' => 'required|integer',
            'years' => 'required|integer',
            'notes' => 'nullable|string|max:255',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {

            $archive =  Archive::create([
                'user_id' => Auth::user()->id,
                'destination' => $request->destination,
                'month' => $request->month,
                'years' => $request->years,
                'notes' => $request->notes,
            ]);


            // file upload
            foreach ($request->file('image') as $image) {
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/archive'), $filename);
                $url = 'uploads/archive/' . $filename;


                ArchiveImage::create([
                    'archive_id' => $archive->id,
                    'image' => $url,
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Archive created successfully',
            ], 201);
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Failed to create archive',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $validator = validator::make($request->all(), [
            'destination' => 'nullable|string|max:255',
            'month' => 'nullable|integer',
            'years' => 'nullable|integer',
            'notes' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        if (!$request->id) {
            return response()->json([
                'status' => false,
                'message' => 'Archive not found',
            ], 404);
        }


        $archive = Archive::where('id', $request->id)->update([
            'user_id' => Auth::user()->id,
            'destination' => $request->destination,
            'month' => $request->month,
            'years' => $request->years,
            'notes' => $request->notes,
        ]);


        // file upload
        foreach ($request->file('image') as $image) {
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/archive'), $filename);
            $url = 'uploads/archive/' . $filename;


            ArchiveImage::create([
                'archive_id' => $archive->id,
                'image' => $url,
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Archive updated successfully',

        ]);
    }

    // archive single image delete
    public function imageDelete(Request $request)
    {
        Archive::with('images')->where('id', $request->id)->each(function ($archive) {
            $archive->images->each(function ($image) {
                ArchiveImage::where('id', $image->id)->delete();
            });
        });

        return response()->json([
            'status' => true,
            'message' => 'Image deleted successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
