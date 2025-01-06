@extends('layouts.app')
@section("title","posts")
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
<div class="d-flex mt-5 mb-5">
<div class="container">
 @forelse($posts as $post)
  <div class="card">
    @php 
    $user = $users->find($post->user_id);
    @endphp
    <div class="card-header">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="/images/users/{{$user->image}}" alt="Logo" width="30" height="24" class="rounded d-inline-block align-text-top">
          {{$user->name}}
        </a>
      </div>
    </div>
    @php 
    $x=$post->image;
    @endphp
    <div class="d-flex flex-wrap">
     @foreach($x as $val)
     <img style="width:50%" class="rounded float-start card-img-top" src="/images/posts/{{$val}}">
    @endforeach
    </div>
    <div class="card-body">
    <h1>{{$post->title}}</h1>
    <p>{{$post->description}}</p>
    @php 
    $category = $categories->find($post->category_id);
    @endphp

<div class="card border-light mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="/images/categories/{{$category->image_category}}" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">Category:</h5>
        <p class="card-text">{{$category->title}}</p>
        <p class="card-text"><small class="text-body-secondary">Created at:{{$category->created_at}} </small></p>
      </div>
    </div>
  </div>
</div>
    
    @php
    $tags_post=$post->tags;
    @endphp
<div class="card border-light" style="width: 18rem;">
  <div class="card-header">
    <strong>Tags</strong>
  </div>
  <ul class="list-group list-group-flush">
    @foreach ($tags_post as $tag_post)
    <li class="list-group-item">{{ $tag_post->word }}</li>
    @endforeach
  </ul>
</div>
    <a href="{{route('posts.show',$post)}}" class="btn btn-primary mt-5 ">show post</a>
    @can('sameUserpost',$post)
    <a href="{{route('posts.edit',$post)}}" class="btn btn-secondary mt-5 ">edit post</a>
    @endcan
    @can('sameUserpost',$post)
    <form method="POST" action="{{ route('posts.destroy', $post) }}" class="btn btn-danger mt-5 pt-0 pb-0"> 
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">delete post</button>
    </form>
   @endcan
  </div>
  </div>
</div>
  @empty
   <h1>there is no posts</h1>
  @endforelse
</div>
  @endsection