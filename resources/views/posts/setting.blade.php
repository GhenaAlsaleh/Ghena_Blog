@extends('layouts.app')
@section("title","setting admin")
@section("content")
<div class="col-md-3">
    <div class="well">
     @can('manageUser',Auth::user())
     <a href="{{route('users.index')}}" class="btn btn-primary mb-5">show all users</a>
     @endcan
     @can('manageUser',Auth::user())
      <a href="{{route('users.create')}}" class="btn btn-primary mb-5">add new user</a>
     @endcan
    </div>
 </div>

 <div class="col-md-3">
    <div class="well">
 @can('manageUser',Auth::user())
 <a href="{{route('categories.index')}}" class="btn btn-primary mb-5">show all categories</a>
 @endcan

 @can('manageUser',Auth::user())
 <a href="{{route('categories.create')}}" class="btn btn-primary mb-5">add new category</a>
 @endcan
</div>
</div>
<div class="col-md-3">
    <div class="well">
 @can('manageUser',Auth::user())
<a href="{{route('tags.index')}}" class="btn btn-primary mb-5">show all tags</a>
@endcan

@can('manageUser',Auth::user())
 <a href="{{route('tags.create')}}" class="btn btn-primary mb-5">add new tag</a>
 @endcan

</div>
</div>
@endsection


