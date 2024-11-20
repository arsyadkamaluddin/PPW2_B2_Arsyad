<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * @OA\Schema(
     *     schema="GalleryResource",
     *     type="object",
     *     @OA\Property(property="id", type="integer"),
     *     @OA\Property(property="title", type="string"),
     *     @OA\Property(property="description", type="string"),
     *     @OA\Property(property="picture", type="string"),
     *     @OA\Property(property="created_at", type="date", format="date"),
     *     @OA\Property(property="updated_at", type="date", format="date")
     * )
     *
     * @OA\Get(
     *   tags={"Gallery"},
     *   path="/api/gallery",
     *   summary="Get all galleries data",
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="data",
     *         type="array",
     *         @OA\Items(ref="#/components/schemas/GalleryResource")
     *       ),
     *     )
     *   )
     * )
     */
    public function index()
    {
        $photos = Photo::all();
        return response()->json(["message" => "Berhasil mendapatkan semua data foto", "success" => true, "galleries" => $photos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
