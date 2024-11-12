<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = Photo::paginate(10);
        return view('photo.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('photo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'picture' => 'image|max:1999'
        ]);
        if ($request->hasFile('picture')) {
            $extension = $request->file('picture')->getClientOriginalExtension();
            $basename = uniqid().time();
            $filenameSimpan = "{$basename}.{$extension}";
            $path = Storage::disk('public')->putFileAs('photos',$request->file('picture'),$filenameSimpan);
        }
        $post = new Photo();
        $post->picture = $path;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();
        return redirect('photos')->with('success', 'Berhasil menambahkan data baru');
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
    public function edit(Photo $photo){
        return view('photo.edit',compact("photo"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        $photo->update($request->all());
        if($request->hasFile('picture')){
            if($photo->picture){
                Storage::disk('public')->delete($photo->picture);
            }
            $fullName = $request->file('photos')->getClientOriginalName();
            $filename = pathinfo($fullName,PATHINFO_FILENAME);
            $extension = $request->file('photos')->getClientOriginalExtension();
            $saveFile = $filename . '_' . time() . '.' . $extension;
            $path = Storage::disk('public')->putFileAs('photos',$request->file('picture'),$saveFile);
            $photo->picture = $path;
        }
        $photo->save();        
        return redirect(route('photos.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        if($photo->picture){
            Storage::disk('public')->delete($photo->picture);
        }
        $photo->delete();
        return redirect(route('photos.index'));
    }
}
