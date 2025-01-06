@extends('layouts.app')
@section("title","login")
@section("content")
<form method="POST" action="{{ route('login') }}" class="mt-5 mb-5"> 
    @csrf
    <input class="form-control" type="email" name="email" placeholder="enter your email">
    <br>
    <input class="form-control" type="password" name="password" placeholder="enter your password" >
    <br>
    
    <input type="submit" value="login" class="btn btn-secondary mt-5">
  </form>
@endsection