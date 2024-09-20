<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\tag;
class CategoryController extends Controller
{
  function category_user(){
    $categories=Category::all();
    return view('layouts.admin.category.category',compact('categories'));
  }

  function category_add(Request $request){
    $request->validate([
      'category_name'=>['required'],
      'category_image'=>['required','mimes:png,jpg','max:1024']
    ]);
    $category_img=$request->category_image;
    $extension=$category_img->extension();
    $file_name=uniqid().".".$extension;
    $manager = new ImageManager(new Driver());
    $image = $manager->read($category_img);
    $image->resize( 200,200);
    $image->save(public_path("uploads/category/".$file_name));


    Category::insert([
      'category_name'=>$request->category_name,
      'category_image'=>$file_name,
      'created_at'=>Carbon::now(),
    ]);
    return back()->with('category_add','Category Added Successfully');
  }
 function category_edit($category_id){
    $category=Category::find($category_id);
   return view('layouts.admin.category.category_edit',compact('category'));

 }
function category_update(Request $request,$category_id){
    $category=Category::find($category_id);
    $request->validate([
      'category_name'=>['unique:categories'],
      'category_image'=>['mimes:png,jpg','max:1024']
    ]);
     if($request->category_image !=""){
        $request->validate([
            'category_image'=>['mimes:png,jpg','max:1024']
          ]);
          $delete=public_path('uploads/category/'.$category->category_image);
          unlink($delete);
          $category_img=$request->category_image;
          $extension=$category_img->extension();
          $file_name=uniqid().".".$extension;
          $manager = new ImageManager(new Driver());
          $image = $manager->read($category_img);
          $image->resize( 200,200);
          $image->save(public_path("uploads/category/".$file_name));
          Category::find($category_id)->update([
             'category_name'=>$request->category_name,
             'category_image'=>$file_name,
          ]);
          return redirect()->route('category.user')->with('cat_update','Category Update Successfully');
    }
  }
 function category_delete($category_id){
     $category=Category::find($category_id)->delete();
     return back()->with('cat_delete','Category Deleted Successfully');
 }

 function category_trash(){
    $Category_trash=Category::onlyTrashed()->get();
   return view('layouts.admin.category.category_trash',compact('Category_trash'));
 }

function category_restore($category_id){
    Category::onlyTrashed()->find($category_id)->restore();
    return back()->with('cat_restore','Category Restore Successfully');
}

function category_hard_delete($category_id){
    $delete=public_path('uploads/category/'.Category::onlyTrashed()->find($category_id)->category_image);
    unlink($delete);
    Category::onlyTrashed()->find($category_id)->forceDelete();
    return back()->with('cat_hard_delete','Category Hard Delete Successfully');
}
function check_delete(Request $request){
   foreach($request->category_id as $cat_id){
       Category::find($cat_id)->delete();
   }
   return back()->with('cat_delete','Check category deleted successfully');
}

function restore_delete_check(Request $request){
     if($request->action_btn==1){
        foreach($request->category_id as $cat_id){
            Category::onlyTrashed()->find($cat_id)->restore();
         }
         return back()->with('cat_restore','Category Restore Successfully');
    }else{
       foreach($request->category_id as $cat_id){
          $delete=public_path('uploads/category/'.Category::onlyTrashed()->find($cat_id)->category_image);
          unlink($delete);
           Category::onlyTrashed()->find($cat_id)->forceDelete();
       }
       return back()->with('cat_delete','Check category deleted successfully');
    }

}

function tags_list(){
    $tags=Tag::all();
    return view('layouts.admin.category.tag_list',compact('tags'));
}
function tags_add(Request $request){
    Tag::insert([
        'tag_name'=>$request->tag_name,
        'created_at'=>Carbon::now(),
    ]);
    return back()->with('tag_add','Tag Added Successfully');
}

function tag_list_delete($tag_id){
   Tag::find($tag_id)->delete();
   return back()->with('tag_delete','Tag Deleted Successfully');
}


}

