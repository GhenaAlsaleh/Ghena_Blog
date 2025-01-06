@extends('layouts.app')
@section("title","edit user")
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
           <a class="nav-link active " aria-current="page" href="{{route('users.create')}}">Add new user</a>
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
 <h1 class="mt-5 mb-5">edit {{ $user->name }} user</h1>
 <a href="{{route('users.change-password',$user)}}" class="btn btn-secondary mt-5 mb-5">Change Password</a>
 <form action="{{route('users.update',$user)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input class="form-control" type="text" name="name" placeholder="user name" value="{{ $user->name }}">
    <br>
    <input class="form-control" type="text" name="email" placeholder="user email" value="{{ $user->email }}">
    <br>
    <input class="form-control" type="file" name="image" id="imageu">
    <lable for="imageu">
       <img src="/images/users/{{$user->image}}">
      </lable>
    <br>
    <input type="submit" value="send" class="btn btn-secondary mt-5">
 </form>
 @endsection