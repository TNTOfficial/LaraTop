<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\gallery;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $images = gallery::latest()->get();
        return view('dashboard/gallery/index', ['images' => $images]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard/gallery/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function uploadImage(Request $request)
    {
        $image = $request->file('file');
        $fileInfo = $image->getClientOriginalName();
        $filename = pathinfo($fileInfo, PATHINFO_FILENAME);
        $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
        $file_name = $filename . '-' . time() . '.' . $extension;

        Storage::disk('public')->put(
            'gallery/' . $file_name,
            file_get_contents($image)
        );

        $imageUpload = new Gallery;
        $imageUpload->name = $fileInfo;
        $imageUpload->image = $file_name;
        $imageUpload->save();
        return response()->json(['success' => $file_name]);
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
        $item = Gallery::findOrFail($id);
        return view('dashboard/gallery/edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Gallery::find($id);

        if ($item) {
            $updateData = [];

            if ($request->filled('croppedImage')) {
                $extension = explode('/', mime_content_type($request->croppedImage))[1];
                $imageName = "Gallery-" . now()->timestamp . "." . $extension;
                Storage::disk('public')->put(
                    'gallery/' . $imageName,
                    file_get_contents($request->croppedImage)
                );
                $updateData["image"] = $imageName;

                Storage::disk('public')->delete('gallery/' . $item->image);
            }

            $item->update($updateData);
        }

        return redirect()->route('gallery.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $galleryItem = Gallery::findOrFail($id);
        Storage::disk('public')->delete('gallery/' . $galleryItem->image);

        $galleryItem->delete();

        return redirect()->back();
    }
}
