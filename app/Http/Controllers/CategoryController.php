<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\category;
use App\Models\Category as ModelsCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("manageUser",User::class);
        $categories=Category::all();
        return view("categories.index",compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("manageUser",User::class);
        return view("categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize("manageUser",User::class);
        $request->validate([
            "title"=>"required|string",
            "image_category"=>"required",
        ]);
        if($request->hasFile("image_category")){
            $imageName=$request->file("image_category")->getClientOriginalName()."-".time().".".$request->file("image_category")->getClientOriginalExtension();
            $request->file("image_category")->move(public_path("/images/categories"),$imageName);
        }
        Category::create([
            "title"=>$request->title,
            "image_category"=>$imageName
        ]);
        return redirect()->route("categories.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        $this->authorize("manageUser",User::class);
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        $this->authorize("manageUser",User::class);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category $category)
    {
        $this->authorize("manageUser",User::class);
        if($request->hasFile("image_category")){
            $request->validate([
                "title"=>"required|string",
                "image_category"=>"required",
            ]);
            $imageName=$request->file("image_category")->getClientOriginalName()."-".time().".".$request->file("image_category")->getClientOriginalExtension();
            $request->file("image_category")->move(public_path("/images/categories"),$imageName);
            $image_path=public_path("/images/categories/".$category->image_category);
             if(file_exists($image_path))
              {
               unlink($image_path);
              }
        }else{
            $request->validate([
                "title"=>"required|string",
            ]);
            $imageName=$category->image_category;
        }
        $category->update([
            'title' => $request->input('title'),
            'image_category' => $imageName
        ]);

        return redirect()->route('categories.index'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        $this->authorize("manageUser",User::class);
        $image_path=public_path("/images/categories/".$category->image_category);
             if(file_exists($image_path))
              {
               unlink($image_path);
              }
        $category->delete();
        return redirect()->route('categories.index');
    }
}
