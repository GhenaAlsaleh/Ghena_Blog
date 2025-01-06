<?php

namespace App\Http\Controllers;

use App\Models\tag;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Session as FacadesSession;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("manageUser",User::class);
        $tags=Tag::all();
        return view("tags.index",compact("tags"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("manageUser",User::class);
        return view("tags.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize("manageUser",User::class);
        $request->validate([
            "word"=>"required|string|max:255"
        ]);
        Tag::create([
            "word"=>$request->word
        ]);
        return redirect()->route("tags.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(tag $tag)
    {
        $this->authorize("manageUser",User::class);
        return view('tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tag $tag)
    {
        $this->authorize("manageUser",User::class);
        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tag $tag)
    {
        $this->authorize("manageUser",User::class);
         $request->validate([
            "word"=>"required|string|max:255"
        ]);
        $tag->update([
            "word"=>$request->word
        ]);

        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tag $tag)
    {
        $this->authorize("manageUser",User::class);
        $tag->delete();
        return redirect()->route('tags.index');
    }
}
