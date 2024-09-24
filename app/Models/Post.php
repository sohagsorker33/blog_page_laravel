<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\author;

class Post extends Model
{
    use HasFactory;

    protected $guarded =['id'];

    function cat_relation(){
        return $this->belongsTo(Category::class,'category_id');
    }
    function author_relation(){
        return $this->belongsTo(author::class,'author_id');
    }
    function tag_relation(){
        return $this->belongsTo(tag::class,'tags');
    }
}
