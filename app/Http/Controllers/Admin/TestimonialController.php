<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Testimonial::orderBy('order')->get();
        return view('dashboard/testimonial/index', ['items' => $items]);
    }
    public function sort(Request $request)
    {
        $items = Testimonial::orderBy('order')->get();
        return view('dashboard/testimonial/sortable', ['items' => $items]);
    }

    public function updateOrder(Request $request)
    {
        $ids = $request->input('order');
        foreach ($ids as $index => $id) {
            Testimonial::where('id', $id)->update(['order' => $index + 1]);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard/testimonial/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lastRecord = Testimonial::orderByDesc('order')->first();
        $request->validate([
            "name" => "required|max:255",
            "designation" => "required|max:255",
            "message" => "required|min:20",
        ]);
        $creationData = $request->only(["name", "designation", "message",]);
        $creationData["status"] = $request->input('status') == "on" ? 1 : 0;
        if ($request->croppedImage != null) {
            $extension = explode('/', mime_content_type($request->croppedImage))[1];
            $imageName = "testimonial-" . now()->timestamp . "." . $extension;
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
        Testimonial::create($creationData);
        return redirect()->route('testimonials.index');
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
        $item = Testimonial::find($id);
        return view('dashboard/testimonial/edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required|max:255",
            "designation" => "required|max:255",
            "message" => "required|min:20",
        ]);

        $item = Testimonial::find($id);

        if ($item) {
            $updateData = $request->only(["name", "designation", "message"]);
            $updateData["status"] = $request->input('status') == "on" ? 1 : 0;

            if ($request->croppedImage != null) {
                $extension = explode('/', mime_content_type($request->croppedImage))[1];
                $imageName = "testimonial-" . now()->timestamp . "." . $extension;
                Storage::disk('public')->put(
                    $imageName,
                    file_get_contents($request->croppedImage)
                );
                $updateData["image"] = $imageName;
                Storage::disk('public')->delete($item->image);
            }

            $item->update($updateData);
        }
        return redirect()->route('testimonials.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Testimonial::find($id);
        if ($item) {
            Storage::disk('public')->delete($item->image);
        }
        $item->delete();
        return redirect()->route('testimonials.index');
    }
}
