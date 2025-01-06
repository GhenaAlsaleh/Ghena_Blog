@extends('layouts.app')
@section("title","edit comment")
@section("content")
<div class="well">
 <h1 class="mt-5 mb-5">edit comment</h1>
 <form action="{{route('comments.update',$comment)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input class="form-control" type="text" name="content" placeholder="comment content" value="{{ $comment->content }}">
    <br>
    <input type="submit" value="send" class="btn btn-secondary mt-5">
 </form>
</div>
 @endsection