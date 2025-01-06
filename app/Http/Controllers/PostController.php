<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\User;
use App\Models\tag;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::all();
        $users=User::all();
        $categories=Category::all();
        return view("posts.index",compact("posts","users","categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        $tags=Tag::all();
        return view("posts.create",compact("categories","tags"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "title"=>"required|string",
            "description"=>"required|string",
            "image"=>"required|array",
            "category_id"=>"required|integer",
            "tag_id" =>"required| array",
            "tag_id.*" => "required|integer"
        ]);
        $images=array();
        
        if($files=$request->file("image")){
            foreach($files as $file){
            $imageN=$file->getClientOriginalName()."-".time().".".$file->getClientOriginalExtension();
            $imageName=$imageN;
            $file->move(public_path("/images/posts"),$imageN);
            $images[]=$imageName;

            }
        
        }
   
        $post=new Post([
            'title'=>$request->title,
            'description'=>$request->description,
            'image'=>$images,
            'category_id'=>$request->category_id,
            'user_id'=>Auth::user()->id,
        ]);
        $userid=Auth::user()->id;
        $user = User::find($userid);
        $postt=$user->posts()->save($post);
        $postt->tags()->attach($request->tag_id);
        return redirect()->route("posts.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $users=User::all();
        $categories=Category::all();
        $tags_post=$post->tags;
        $comments_post=$post->comments;
        return view('posts.show', compact('post','users','categories','tags_post','comments_post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize("sameUserpost",$post);
        $tags=Tag::all();
        $categories=Category::all();
        $tags_post=$post->tags;
        return view('posts.edit', compact('post','categories','tags','tags_post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize("sameUserpost",$post);
        $images=array();
        if($files=$request->file("image")){
            $request->validate([
                "title"=>"required|string",
                "description"=>"required|string",
                "image"=>"required|array",
                "category_id"=>"required|integer",
                "tag_id" =>"required| array",
                "tag_id.*" => "required|integer"
            ]);
            foreach($files as $file){
            $imageN=$file->getClientOriginalName()."-".time().".".$file->getClientOriginalExtension();
            $imageName=$imageN;
            $file->move(public_path("/images/posts"),$imageN);
            $images[]=$imageName;

            }
            $x=$post->image;
            foreach($x as $val){
             $image_path=public_path("/images/posts/".$val);
             if(file_exists($image_path))
              {
               unlink($image_path);
              }
            }
            $post->tags()->detach();
            $post->update([
                'title' => $request->title,
                'description' => $request->description,
                'user_id'=>Auth::user()->id,
                "image"=>$images,
                'category_id'=>$request->category_id
            ]);
            $post->tags()->attach($request->tag_id);
    

    
    
        }else{
            $request->validate([
                "title"=>"required|string",
                "description"=>"required|string",
                "category_id"=>"required|integer",
                "tag_id" =>"required| array",
                "tag_id.*" => "required|integer"
            ]);
            $post->tags()->detach();
            $post->update([
                'title' => $request->title,
                'description' => $request->description,
                'user_id'=>Auth::user()->id,
                'category_id'=>$request->category_id,
            ]);
            $post->tags()->attach($request->tag_id);
        }
 
        return redirect()->route('posts.index'); 
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize("sameUserpost",$post);
            $x=$post->image;
            foreach($x as $val){
             $image_path=public_path("/images/posts/".$val);
             if(file_exists($image_path))
              {
               unlink($image_path);
              }
            }
           $post->tags()->detach();
            $post->delete();

        return redirect()->route('posts.index');
    }

    public function setting()
    {
    
        return view("posts.setting");
    }

}
