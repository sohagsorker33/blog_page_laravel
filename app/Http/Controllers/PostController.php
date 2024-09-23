<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Show;
use App\Models\tag;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use PHPUnit\TextUI\Command\ShowVersionCommand;

class PostController extends Controller
{
    function add_post(){
        $categories = Category::all();
        $tags = Tag::all();
        return view('frontend.author.add_post',[
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

 function post_insert(Request $request){
    //preview image

  $preview=$request->preview;
  $extension=$preview->extension();
  $preview_name=uniqid().".".$extension;
  $manager = new ImageManager(new Driver());
  $image = $manager->read($preview);
  $image->resize( 1000,450);
  $image->save(public_path("uploads/post/preview/".$preview_name));
// thumbnail image
  $thumbnail=$request->thumbnail;
  $extension=$thumbnail->extension();
  $thumbnail_name=uniqid().".".$extension;
  $manager = new ImageManager(new Driver());
  $image = $manager->read($thumbnail);
  $image->resize( 200,200);
  $image->save(public_path("uploads/post/thumbnail/".$thumbnail_name));

  Post::insert(values: [
   'author_id'=>Auth::guard('author')->id(),
   'category_id'=>$request->category_id,
   'read_time'=>$request->read_time,
   'title'=>$request->title,
   'description'=>$request->description,
   'tags'=>implode(",",$request->tag_id),
   'preview'=>$preview_name,
   'thumbnail'=>$thumbnail_name,
   'created_at'=>Carbon::now(),
  ]);
  return back()->with('post_add','Post Added Successfully');
 }



}
