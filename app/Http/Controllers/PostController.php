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
use Illuminate\Support\Str;
use App\Models\author;
use App\Models\Popular;

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
   'slug'=>Str::lower(str_replace(" ","-",$request->title)).''.random_int(100000,200000),
   'description'=>$request->description,
   'tags'=>implode(",",$request->tag_id),
   'preview'=>$preview_name,
   'thumbnail'=>$thumbnail_name,
   'created_at'=>Carbon::now(),
  ]);
  return back()->with('post_add','Post Added Successfully');
 }





 function my_post(){
    $posts=Post::where('author_id',Auth::guard('author')->id())->paginate(2);
   return view('frontend.author.my_post',[
    'posts' => $posts
   ]);

 }

function my_post_status($post_id){
   $posts=Post::find($post_id);
   if($posts->status==1){
    Post::find($post_id)->update([
        'status'=>0
    ]);
    return back();
   }else{
    Post::find($post_id)->update([
        'status'=>1
    ]);
    return back();
   }

}
 function post_delete($post_id){
    $posts=Post::find($post_id);
    $delete_preview=public_path("uploads/post/preview/").$posts->preview;
    $delete_thumbnail=public_path("uploads/post/thumbnail/").$posts->thumbnail;
    unlink($delete_preview);
    unlink($delete_thumbnail);
    Post::find($post_id)->delete();
    return back()->with('post_delete','Post Deleted Successfully');
 }

 function post_details($slug){
    $post=Post::where('slug',operator: $slug)->first();
    if(Popular::where('post_id',$post->id)->exists()){
      Popular::where('post_id',$post->id)->increment('total_count',1);
    }else{
        Popular::insert([
            'post_id'=>$post->id,
            'total_count'=>1
          ]);
    }
    return view('frontend.author.post_details',[
        'post' => $post,

    ]);
 }

 function author_post($author_id){
 $author=Author::find($author_id);
 $post=Post::where('author_id',$author_id)->where('status',1)->get();
  return view('frontend.author.author_post',[
    'author' => $author,
     'post' => $post,

  ]);
 }


 function category_post($category_id){
    $category=Category::find($category_id);
    $post=Post::where('category_id',$category_id)->get();
    return view('frontend.author.category',[
        'category' => $category,
        'post' => $post
    ]);
 }

}
