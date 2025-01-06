<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Post $post)
    {
        $request->validate([
            "content"=>"required|string"
        ]);
       $comment=new Comment([
            'post_id'=>$post->id,
            'user_id'=>Auth::user()->id,
            'content'=>$request->content
        ]);
        
       $post->comments()->save($comment);

        return redirect()->route('posts.show',compact('post')); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        $this->authorize("sameUsercomment",$comment);
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize("sameUsercomment",$comment);
        $request->validate([
            "content"=>"required|string"
        ]);
        $comment->update([
            'content' => $request->content,
        ]);
        $post= Post::find($comment->post_id);
        $users=User::all();
        $categories=Category::all();
        $tags_post=$post->tags;
        $comments_post=$post->comments;
        return view('posts.show', compact('post','users','categories','tags_post','comments_post')); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize("sameUsercommentorpost",$comment);
        $post= Post::find($comment->post_id);
        $comment->delete();
        $users=User::all();
        $categories=Category::all();
        $tags_post=$post->tags;
        $comments_post=$post->comments;
        return view('posts.show', compact('post','users','categories','tags_post','comments_post'));
    }
}
