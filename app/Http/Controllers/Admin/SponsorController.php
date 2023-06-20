<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sponsor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $items = Sponsor::orderBy('order')->get();
        return view('dashboard/sponsor/index', ['items' => $items]);
    }

    public function sort(Request $request)
    {
        $items = Sponsor::orderBy('order')->get();

        return view('dashboard/sponsor/sortable', ['items' => $items]);
    }

    public function updateOrder(Request $request)
    {
        $ids = $request->input('order');
        foreach ($ids as $index => $id) {
            Sponsor::where('id', $id)->update(['order' => $index + 1]);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard/sponsor/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lastRecord = Sponsor::orderByDesc('order')->first();
        $request->validate([
            "name" => "required|max:255"
        ]);
        $creationData = $request->only(["name"]);
        $creationData["status"] = $request->input('status') == "on" ? 1 : 0;
        if ($request->croppedImage != null) {
            $extension = explode('/', mime_content_type($request->croppedImage))[1];
            $imageName = "sponsor-" . now()->timestamp . "." . $extension;
            //Image::make(file_get_contents($request->croppedImage))->save($path); 
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->croppedImage)
            );
            $creationData["image"] = $imageName;
        }

        if ($lastRecord) {
            $creationData["order"] = $lastRecord->order + 1;
        }
        Sponsor::create($creationData);
        return response()->json([
            'result' => 'success',
            'message' => 'Sponsor has been created successfully',
        ]);
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

        $item = Sponsor::find($id);
        return view('dashboard/sponsor/edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required|max:255"
        ]);

        $item = Sponsor::find($id);

        if ($item) {
            $updateData = $request->only(["name"]);
            $updateData["status"] = $request->input('status') == "on" ? 1 : 0;

            if ($request->croppedImage != null) {
                $extension = explode('/', mime_content_type($request->croppedImage))[1];
                $imageName = "sponsor-" . now()->timestamp . "." . $extension;
                Storage::disk('public')->put(
                    $imageName,
                    file_get_contents($request->croppedImage)
                );
                $updateData["image"] = $imageName;
                Storage::disk('public')->delete($item->image);
            }

            $item->update($updateData);
        }
        return response()->json([
            'result' => 'success',
            'message' => 'Sponsor has been updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Sponsor::find($id);
        if ($item) {
            Storage::disk('public')->delete($item->image);
        }
        $item->delete();
        return redirect()->route('sponsors.index');
    }
}
