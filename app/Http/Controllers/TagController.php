<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('tag/all-tags')->with('tags', $tags);
    }

    public function create()
    {
        return view('tag/create-tag');
    }

    public function save(Request $request)
    {
        $tag = new Tag($request->all());
        $tag->save();
        return redirect()->route('tags.all');
    }

    public function edit(Tag $tag)
    {
        return view('tag/edit-tag')->with('tag', $tag);
    }

    public function update(Request $request, Tag $tag)
    {
        $tag->update($request->all());
        return redirect()->route('tags.all');
    }

    public function delete(Tag $tag)
    {
        $tag->delete();
        return redirect()->back();
    }
}
