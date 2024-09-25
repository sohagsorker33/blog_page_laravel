<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\tag;
class HomeController extends Controller
{
    function master(){
        $tags=Tag::all();
        $categories = Category::all();
        $posts=Post::where('status',1)->paginate(3);
        $sliders=Post::where('status',1)->latest()->take(6)->get();
        return view('frontend.home',[
            'categories' => $categories,
            'posts' => $posts,
            'tags'=>$tags,
            'sliders'=>$sliders

        ]);
    }


}
