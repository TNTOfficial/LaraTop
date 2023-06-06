<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Slider::orderBy('order')->get();
        return view('dashboard/slider/index', ['items' => $items]);
    }

    public function sort(Request $request)
    {
        $items = Slider::orderBy('order')->get();

        return view('dashboard/slider/sortable', ['items' => $items]);
    }

    public function updateOrder(Request $request)
    {
        $ids = $request->input('order');
        foreach ($ids as $index => $id) {
            Slider::where('id', $id)->update(['order' => $index + 1]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard/slider/create');
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lastRecord = Slider::orderByDesc('order')->first();
        $request->validate([
            "title" => "required|max:255",
            "sub_title" => "required|max:255",
        ]);
        $creationData = $request->only(["title", "sub_title"]);
        $creationData["status"] = $request->input('status') == "on" ? 1 : 0;
        if ($request->croppedImage != null) {
            $extension = explode('/', mime_content_type($request->croppedImage))[1];
            $imageName = "slider-" . now()->timestamp . "." . $extension;
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
        Slider::create($creationData);
        return redirect()->route('slides.index');
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
        $item = Slider::find($id);
        return view('dashboard/slider/edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "title" => "required|max:255",
            "sub_title" => "required|max:255",
        ]);

        $item = Slider::find($id);

        if ($item) {
            $updateData = $request->only(["title", "sub_title"]);
            $updateData["status"] = $request->input('status') == "on" ? 1 : 0;

            if ($request->croppedImage != null) {
                $extension = explode('/', mime_content_type($request->croppedImage))[1];
                $imageName = "slider-" . now()->timestamp . "." . $extension;
                Storage::disk('public')->put(
                    $imageName,
                    file_get_contents($request->croppedImage)
                );
                $updateData["image"] = $imageName;
                Storage::disk('public')->delete($item->image);
            }

            $item->update($updateData);
        }
        return redirect()->route('slides.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Slider::find($id);
        if ($item) {
            Storage::disk('public')->delete($item->image);
        }
        $item->delete();
        return redirect()->route('slides.index');
    }
}
