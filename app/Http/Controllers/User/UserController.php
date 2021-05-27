<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\carbon;
use Auth;
use Image;
use Hash;

class UserController extends Controller
{
    public function index(){
        return view('user.home');
    }

    public function updateData(Request $request)
    {
    	 $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ],[
            'name.required' => 'input your name',
        ]);

    	User::findOrFail(Auth::id())->update([
    		'name'			=> $request->name,
    		'email'			=>  $request->email,
    		'phone'			=>  $request->phone,
    		'updated_at'	=> carbon::now()


    	]);

    	    $notification=array(
            'message'=>'Your Profile Updated',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    	
    }

   // update Image 
    public function imageupdate()
    {
        return view('user.imageupdate');
    }

    public function updatepost(Request $request)
    {
        $old_image = $request->old_image;

        if (User::findOrFail(Auth::id())->image == 'upload/media/imran.jpg') {
            $image          = $request->file('image');
            $new_name       = hexdec(uniqid()).'.'.$image->extension();
            Image::make($image)->resize(300,300)->save('upload/media/'.$new_name);
            $save_url = 'upload/media/'.$new_name;
            User::findOrFail(Auth::id())->update([
                'image'         => $save_url 
            ]);

            $notification=array(
            'message'=>'Your successfully Updated',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

        }
        else{
            unlink($old_image);
            $image          = $request->file('image');
            $new_name       = hexdec(uniqid()).'.'.$image->extension();
            Image::make($image)->resize(300,300)->save('upload/media/'.$new_name);
            $save_url = 'upload/media/'.$new_name;
            User::findOrFail(Auth::id())->update([
                'image'         => $save_url 
            ]);

            $notification=array(
            'message'=>'Your successfully Updated',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);


        }
    }

    public function changepasswprd()
    {
        return view('user.changepasswprd');
    }

    public function passwordstore(Request $request)
    {
        $request->validate([
            'old_password'               => 'required',
            'password'                   => 'required|min:8',
            'password_confirmation'      => 'required|min:8'
        ]);

        if ($request->old_password == $request->new_password) {
            $notification=array(
            'message'=>'The Old Password can not ba a new password',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
        }
        else{
            $old_password = $request->old_password;
            $db_password  = Auth::user()->password;

            if (Hash::check($old_password,$db_password)) {
                 User::findOrFail(Auth::user()->id)->update([
                    'password'  => Hash::make($request->password)

                 ]);
               Auth::logout();
               $notification=array(
                'message'=>'Your Password Change Success. Now Login With New Password',
                'alert-type'=>'success'
            );
            return Redirect()->route('login')->with($notification);
             } 
             else{
                    $notification=array(
                    'message'=>'The Old Password is not Right',
                    'alert-type'=>'success'
                );
                return Redirect()->back()->with($notification);

             }
        }
    }
}
