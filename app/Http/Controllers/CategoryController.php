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
        $categories=Category::all();
        return response()->json(["message"=>"this is all categories",$categories],200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "title"=>"required|string",
            "image_category"=>"required",
        ]);
        if($request->hasFile("image_category")){
            $imageName=$request->file("image_category")->getClientOriginalName()."-".time().".".$request->file("image_category")->getClientOriginalExtension();
            $request->file("image_category")->move(public_path("/images/categories"),$imageName);
        }
        $category=Category::create([
            "title"=>$request->title,
            "image_category"=>$imageName
        ]);
        return response()->json(["message"=>"category added successfully","category"=>$category],200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category=Category::find($id);
        if(!$category){
            return response()->json(["message"=>"category not found"],404);
        }
        return response()->json(["message"=>"show category successfuly","category"=>$category],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category=Category::find($id);
        if(!$category){
            return response()->json(["message"=>"category not found"],404);
        }
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

        return response()->json(["message"=>"category updated successfuly","category"=>$category],200); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category=Category::find($id);
        if(!$category){
            return response()->json(["message"=>"category not found"],404);
        }
        $image_path=public_path("/images/categories/".$category->image_category);
             if(file_exists($image_path))
              {
               unlink($image_path);
              }
        $category->delete();
        return response()->json(["message"=>"category deleted successfully"],200);
    }
}
