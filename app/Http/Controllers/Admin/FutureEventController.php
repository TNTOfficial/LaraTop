<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FutureEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class FutureEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = FutureEvent::get();
        return view('dashboard/futureEvents/index', ["items" => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard/futureEvents/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lastRecord = FutureEvent::orderByDesc('order')->first();
        $request->validate([
            "title" => "required|max:255",
            "sub_title" => "required|max:255",
            "description" => "required",
            "event_date" => "required",
        ]);
        $creationData = $request->only(["title", "sub_title", "description", "event_date"]);
        $creationData["status"] = $request->input('status') == "on" ? 1 : 0;

        $creationData["event_date"] = Carbon::createFromFormat('d/m/Y', $request->input('event_date'));
        if ($request->croppedImage != null) {
            $extension = explode('/', mime_content_type($request->croppedImage))[1];
            $imageName = "FutureEvents-" . now()->timestamp . "." . $extension;
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
        FutureEvent::create($creationData);
        return response()->json([
            'result' => 'success',
            'message' => 'Event has been created successfully',
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
        $item = FutureEvent::find($id);
        return view('dashboard/futureEvents/edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "title" => "required|max:255",
            "sub_title" => "required|max:255",
            "description" => "required",
            "event_date" => "required",
        ]);

        $item = FutureEvent::find($id);

        if ($item) {
            $updateData = $request->only(["title", "sub_title", "description", "event_date"]);
            $updateData["status"] = $request->input('status') == "on" ? 1 : 0;
            $updateData["event_date"] = Carbon::createFromFormat('d/m/Y', $request->input('event_date'));

            if ($request->croppedImage != null) {
                $extension = explode('/', mime_content_type($request->croppedImage))[1];
                $imageName = "FutureEvents-" . now()->timestamp . "." . $extension;
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
            'message' => 'Event has been updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $item = FutureEvent::find($id);
        if ($item) {
            Storage::disk('public')->delete($item->image);
        }
        $item->delete();
        return redirect()->route('futureEvents.index');
    }
}
