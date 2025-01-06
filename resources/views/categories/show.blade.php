@extends('layouts.app')
@section("title","show category")
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
          <a class="nav-link active " aria-current="page" href="{{route('categories.create')}}">Add new category</a>
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
  <div class="card mb-5 mt-5">
    <img src="/images/categories/{{$category->image_category}}">
    <h1>title:{{$category->title}}</h1>
    <a href="{{route('posts.index')}}" class="btn btn-primary mb-5 mt-5">main page</a>
    <a href="{{route('categories.edit',$category)}}" class="btn btn-secondary mt-5 mb-5">edit category</a>
    @can('manageUser',Auth::user())
    <form method="POST" action="{{ route('categories.destroy', $category) }}" class="btn btn-danger mt-5 mb-5 pt-0 pb-0"> 
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">delete category</button>
    </form>
    @endcan
  </div>
  @endsection