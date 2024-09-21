<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\author;
Use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
class AuthorController extends Controller
{
     function Author_insert_register(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:authors',
            'password' => 'required'
        ]);
        Author::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('add_author','Author Added Successfully');
     }

     function author_login_post(Request $request){
        if(author::where('email',$request->email)->exists()){
            if(Auth::guard('author')->attempt(['email' => $request->email, 'password' => $request->password])){
               if(Auth::guard('author')->user()->status != 1){
                Auth::guard('author')->logout();
                 return back()->with('panding','Your Account is  a panding  for approval!');
               }
               else{
                return redirect()->route('master');
               }
            }else{
                return back()->with('author','Author Password does not exist');
            }
        }else{
            return back()->with('arr','Author Email does not exist');
        }
     }

     function author_logout(){
        Auth::guard('author')->logout();
        return redirect('/');
     }

    function author_admin_panel(){
         return view('frontend.author.author_admin_panel');
     }

     function admin_home(){
        return view('frontend.author.admin_home');
     }
      function author_edit(){
        return view('frontend.author.author_edit');
     }
function author_profile_update(Request $request){
 if($request->photo ==''){
     Author::find(Auth::guard('author')->id())->update([
       'name'=>$request->name,
       'email'=>$request->email
     ]) ;
 }else{
  $photo=$request->photo;
  $extension=$photo->extension();
  $file_name=uniqid().".".$extension;
  $manager = new ImageManager(new Driver());
  $image = $manager->read($photo);
  $image->resize( 200,200);
  $image->save(public_path("uploads/author/".$file_name));
  if(Auth::guard('author')->user()->photo !=null){
      $delete_form=public_path("uploads/author/".Auth::guard('author')->user()->photo);
      unlink($delete_form);
  }
  Author::find(Auth::guard('author')->id())->update([
    'name'=>$request->name,
    'email'=>$request->email,
    'photo'=>$file_name,
  ]);
 }
  return back()->with('update','Profile Updated Successfully');
}

}
