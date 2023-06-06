<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogsController extends Controller
{
    public function index()
    {
        return view('layouts/frontend/blog');
    }

    public function create()
    {
        return view('layouts/frontend/createblog');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'image' => 'required|image',
            'content' => 'required',
        ]);

        $creationData = [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => auth()->user()->id,
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = "blogs-" . now()->timestamp . "." . $image->getClientOriginalExtension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->image)
            );
            $creationData["image"] = $imageName;
        }

        auth()->user()->blogs()->create($creationData);

        return back()->with('success', 'Blog created successfully , the blog will be visible after review.');
    }
}
