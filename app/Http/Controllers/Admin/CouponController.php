<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CouponController extends Controller
{
    //First check admin or not
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function coupon(){
    	$coupon = DB::table('coupons')->get();
    	return view('admin.coupon.coupon',compact('coupon'));
    }

    public function storecoupon(Request $request){
    	$validatedData = $request->validate([
        'coupon' => 'required|unique:coupons|max:55',
        'discount' => 'required:coupons',
        ]);

        $data = array();
        $data['coupon'] = $request->coupon;
        $data['discount'] = $request->discount;

        DB::table('coupons')->insert($data);

        $notification=array(
                 'messege'=>'Coupon Inserted Done',
                 'alert-type'=>'success'
                       );
            return Redirect()->back()->with($notification);
    }

    public function deletecoupon($id){
    	$coupon = DB::table('coupons')->where('id',$id)->delete();
    	 $notification=array(
                 'messege'=>'Coupon Deleted Done',
                 'alert-type'=>'success'
                       );
            return Redirect()->back()->with($notification);
    }

    public function EditCoupon($id){
    	$coupon = DB::table('coupons')->where('id',$id)->first();
    	return view('admin.coupon.edit_coupon',compact('coupon'));
    }

     public function updatecoupon(Request $request,$id){
     	 
        $data = array();
        $data['coupon'] = $request->coupon;
        $data['discount'] = $request->discount;

        DB::table('coupons')->where('id',$id)->update($data);

        $notification=array(
                 'messege'=>'Coupon Updated Done',
                 'alert-type'=>'success'
                       );
            return Redirect()->route('coupon')->with($notification);
    }

    //Newslaters 

    public function newslaters(){
    	$newslaters = DB::table('newslaters')->get();
    	//return response()->json($newslaters);
    	return view('admin.coupon.newslaters',compact('newslaters'));
    }

    public function deletenewslaters($id){
    	$newslaters = DB::table('newslaters')->where('id',$id)->delete();
    	 $notification=array(
                 'messege'=>'Subscribers Deleted Done',
                 'alert-type'=>'success'
                       );
            return Redirect()->back()->with($notification);
    }



    public function Seo()
    {
        $seo=DB::table('seo')->first();
        //dd($seo);
        return view('admin.coupon.seo',compact('seo'));
    }

    public function UpdateSeo(Request $request)
    {
         $id=$request->id;
         $data=array();
         $data['meta_title']=$request->meta_title;
         $data['meta_author']=$request->meta_author;
         $data['meta_tag']=$request->meta_tag;
         $data['meta_description']=$request->meta_description;
         $data['google_analytics']=$request->google_analytics;
         $data['bing_analytics']=$request->bing_analytics;
         DB::table('seo')->where('id',$id)->update($data);
         $notification=array(
                 'message'=>'SEO Updated',
                 'alert-type'=>'success'
                       );
        return Redirect()->back()->with($notification);
    }

}
