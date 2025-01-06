<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   protected $fillable=[
   "user_id",
   "category_id",
    "title",
    "description",
    "image"
   ];

   protected $casts= [
      'image'=>'array'
   ];

   public function user(){
      return $this->belongsTo(User::class);
   }

   public function tags(){
      return $this->belongsToMany(Tag::class,);
  }

  public function comments(){
   return $this->hasMany(Comment::class);
  }

  public function category(){
   return $this->belongsTo(Category::class);
}
}
