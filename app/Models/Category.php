<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title',
        'image_category'
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }
}
