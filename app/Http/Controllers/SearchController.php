<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Mockery\Undefined;
use App\Models\tag;
use App\Models\Category;
class SearchController extends Controller
{

    public function search(Request $request){
        $data=$request->all();
        $tags=Tag::all();
        $categories=Category::all();
       $search_post=Post::where(function($q)use($data){
         if(!empty($data['search_key']) && $data['search_key'] !='' && $data['search_key'] !='Undefined'){
           $q->where(function ($q)use($data){
             $q->where('title','like','%'.$data['search_key'].'%');
             $q->OrWhere('description','like','%'.$data['search_key'].'%');
           });
         }
       })->get();

      return view('search.search',[
        'search_post'=>$search_post,
        'tags'=>$tags,
        'categories'=>$categories
      ]);
    }
}
