<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;

class PostController extends Controller
{
    //First check admin or not
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function create(){
    	$category = DB::table('post_category')->get();
    	return view('admin.blog.create',compact('category'));
    }

    public function store(Request $request){
    	$data = array();
    	$data['post_title_en']=$request->post_title_en;
    	$data['post_title_bn']=$request->post_title_bn;
    	$data['category_id']=$request->category_id;
    	$data['details_en']=$request->details_en;
    	$data['details_bn']=$request->details_bn;

    	//return response()->json($data);
    	$post_image=$request->post_image;

    	if ($post_image) {
    		 $image_one_name= hexdec(uniqid()).'.'.$post_image->getClientOriginalExtension();
             Image::make($post_image)->resize(400,200)->save('public/media/post/'.$image_one_name);
             $data['post_image']='public/media/post/'.$image_one_name;

             $post=DB::table('posts')->insert($data);
                    $notification=array(
                     'messege'=>'Successfully Post Inserted ',
                     'alert-type'=>'success'
                    );
                return Redirect()->back()->with($notification);


    	}else{

    		$data['post_image']='';

    		$post=DB::table('posts')->insert($data);
                    $notification=array(
                     'messege'=>'Successfully Post Inserted Without Image ',
                     'alert-type'=>'success'
                    );
                return Redirect()->back()->with($notification);
    	}


    }

    public function index(){
    	$post = DB::table('posts')
    			->join('post_category','posts.category_id','post_category.id')
    			->select('posts.*','post_category.category_name_en')
    			->get();

    	return view('admin.blog.index',compact('post'));
    }

    public function destroy($id){
    	$post = DB::table('posts')->where('id',$id)->first();
    	$image = $post->post_image; 
    	//return response()->json($image);
    	unlink($image);

    	$post = DB::table('posts')->where('id',$id)->delete();
    	
    	$notification=array(
                     'messege'=>'Successfully Post Deleted ',
                     'alert-type'=>'success'
                    );
            return Redirect()->back()->with($notification);
    	
    }

    public function edit($id){
    	$category = DB::table('post_category')->get();
    	$post = DB::table('posts')
    			->where('id',$id)
    			->first();

    	return view('admin.blog.edit',compact('category','post'));
    }

    public function update(Request $request,$id){
    	$data = array();
    	$data['post_title_en']=$request->post_title_en;
    	$data['post_title_bn']=$request->post_title_bn;
    	$data['category_id']=$request->category_id;
    	$data['details_en']=$request->details_en;
    	$data['details_bn']=$request->details_bn;

    	$old_image = $request->old_image;
    	$post_image=$request->post_image;

    	if ($post_image) {

    		$old_post = DB::table('posts')->where('id',$id)->first();
    		$image = $old_post->post_image;
    		unlink($image);

    		 $image_one_name= hexdec(uniqid()).'.'.$post_image->getClientOriginalExtension();
             Image::make($post_image)->resize(400,200)->save('public/media/post/'.$image_one_name);
             $data['post_image']='public/media/post/'.$image_one_name;

             $post=DB::table('posts')->where('id',$id)->update($data);
                    $notification=array(
                     'messege'=>'Successfully Post Updated With Pic ',
                     'alert-type'=>'success'
                    );
                return Redirect()->route('all.blogpost')->with($notification);


    	}else{

    		$data['post_image']=$old_image;
    		$post=DB::table('posts')->where('id',$id)->update($data);
                    $notification=array(
                     'messege'=>'Successfully Post Updated Without Pic ',
                     'alert-type'=>'success'
                    );
                return Redirect()->route('all.blogpost')->with($notification);
    	}

    }
}
