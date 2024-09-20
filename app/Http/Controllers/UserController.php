<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Symfony\Component\String\ByteString;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Carbon\Carbon;
use App\Models\author;

class UserController extends Controller
{
    function edit_profile(Request $request){
         return view('layouts.admin.user.edit_profile');
    }


    function update_profile(Request $request){
      User::find(Auth::id())->update([
        'name' => $request->name,
        'email'=>$request->email
      ]);
      return back()->with('status','Profile Updated Successfully');
  }

  function update_password(PasswordRequest $request){
   if(Hash::check($request->current_password,Auth::user()->password)){
     User::find(Auth::id())->update([
       'password'=>bcrypt($request->password)
     ]);
     return back()->with('update','Password Updated Successfully');
   }else{
    return back()->with('err','Current password not matched');
   }
}

function update_photo(Request $request){
 $request->validate([
   'photo'=>['required','mimes:jpg,,png','max:1024']
 ]);

  $photo=$request->photo;
  $extension=$photo->extension();
  $file_name=uniqid().".".$extension;
  $manager = new ImageManager(new Driver());
  $image = $manager->read($photo);
  $image->resize( 200,200);
  $image->save(public_path("uploads/user/".$file_name));
  if(Auth::user()->photo !=null){
      $delete_form=public_path("uploads/user/".Auth::user()->photo);
      unlink($delete_form);
  }
  User::find(Auth::id())->update([
   'photo'=>$file_name,
  ]);
  return back()->with('photo',' Photo Updated Successfully');
}

function user_list(){
    $users=User::all();
    return view('layouts.admin.user.user_list',compact('users'));
}

function user_delete($user_id){
  $user=user::find($user_id);
  if($user->photo !=null){
    $delete_form=public_path('uploads/user/'.$user->photo);
    unlink($delete_form);
  }
  User::find($user_id)->delete();
  return back()->with('delete','User Deleted Successfully');
  }

  function  add_user(Request $request){
     User::insert([
         'name'=>$request->name,
         'email'=>$request->email,
         'password'=>bcrypt($request->password),
         'created_at'=>Carbon::now(),
         'updated_at'=>Carbon::now()
     ]);
     return back()->with('add_user','User Added Successfully');
  }

 function author(){
    $authors=author::all();
    return view('layouts.admin.user.author',compact('authors'));
 }

function author_status($author_id){
   $author=author::find($author_id);
    if($author->status==1){
        author::find($author_id)->update([
            'status'=>0
        ]);
        return back()->with('status','Author status Deactive Successfully');
    }
    else{
        author::find($author_id)->update([
            'status'=>1,
        ]);
        return back()->with('status','Author status Active Successfully');
    }
}
function author_delete($author_id){
  author::find($author_id)->delete();
  return back()->with('delete','Author Deleted Successfully');
}


}
