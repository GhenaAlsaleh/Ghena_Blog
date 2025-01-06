@extends('layouts.app')
@section("title","add post")
@section("content")
<nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: #e3f2fd;">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{route('posts.index')}}">
      <i class="fa-solid fa-blog"></i>
      Blog
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('posts.index')}}">Home</a>
        </li>
        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}" > 
            @csrf
            <input type="submit" value="logout" class="btn btn-secondary ">
          </form>
        </li>
        <li class="nav-item dropdown">
          @can('manageUser',Auth::user())
          <a class="nav-link dropdown-toggle" href="{{route('posts.setting')}}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Setting Blog
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('users.index')}}">Users</a></li>
            <li><a class="dropdown-item" href="{{route('categories.index')}}">Categories</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{route('tags.index')}}">Tags</a></li>
          </ul>
          @endcan
        </li>
        
        <li class="nav-item">
          <a class="nav-link active " aria-current="page" href="{{route('posts.create')}}">Add new post</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">@Ghena</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
 <h1 class="mt-5 mb-5">add new post</h1>
 <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input class="form-control" type="text" name="title" placeholder="post title">
    <br>
    <textarea class="form-control" name="description" placeholder="post placeholder" ></textarea>
    <br>
    <input class="form-control" type="file" name="image[]" multiple>
    <br>
    <label for="mycategory">Select Post Category:</label>
    <select class="form-control" name="category_id" id="mycategory" >
      @foreach ($categories as $category)
      <option value="{{$category->id}}">{{$category->title}}</option>
      @endforeach
    </select>
    <br>
    <label for="mytag">Select Post Tags:</label>
    <select class="form-control" name="tag_id[]" id="mytag" multiple >
      @foreach ($tags as $tag)
      <option value="{{$tag->id}}">{{$tag->word}}</option>
      @endforeach
    </select>
    <br>

    <input type="submit" value="send" class="btn btn-secondary mt-5">
 </form>
 
 @endsection