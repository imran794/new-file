<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;
use Carbon\Carbon;
use Str;

class BrandController extends Controller
{
    public function brand()
    {

    	return view('admin.brand.index',[
    	   'brands'		=> Brand::latest()->get()

    	]);
    }

    public function brandstore(Request $request)
    {
    	$request->validate([
    		'brand_name' 	=> 'required',
    		'brand_image'	=> 'required'
    	]);

    	$brand_image = $request->file('brand_image');
    	$new_name 	 = hexdec(uniqid()).'.'.$brand_image->extension();
    	Image::make($brand_image)->resize(400,400)->save('upload/brandimage/'.$new_name);
    	$save_url = 'upload/brandimage/'.$new_name;

        $slug = Str::slug( $request->product_name_en.'-'.carbon::now()->timestamp);

    	Brand::insert([
    		'brand_name' 	=> $request->brand_name,
    		'brand_image'	=> $save_url,
    		'brand_slug'	=> $slug,
    		'created_at'	=> carbon::now()

    	]);

    	  $notification=array(
            'message'=>'Brand Added Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }

      public function adminactive($id)
    {
    	Brand::findOrFail($id)->update(['status'=> 1]);

    	$notification=array(
            'message'=>'Brand Active Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function admininactive($id)
    {
    	Brand::findOrFail($id)->update(['status'=> 0]);

    	$notification=array(
            'message'=>'Brand Inactive Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
