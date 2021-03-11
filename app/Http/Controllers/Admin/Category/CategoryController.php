<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
use App\Model\Admin\Subcategory;
use App\Model\Admin\Brand;
use DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function category(){
    	$category = Category::all();
    	return view('admin.category.category',compact('category'));
    	//return response()->json($category);
    }

    public function storecategory(Request $request)
    {
    	$validatedData = $request->validate([
        'category_name' => 'required|unique:categories|max:55',
        ]);

        // $data=array();
        // $data['category_name']=$request->category_name;
        // DB::table('categories')->insert($data);

        $category = new Category();
        $category->category_name =$request->category_name;
        $category->save();
        $notification=array(
                 'messege'=>'Category Insert Done',
                 'alert-type'=>'success'
                       );
            return Redirect()->back()->with($notification);
    }

    public function DeleteCategory($id)
    {
    	 DB::table('categories')->where('id',$id)->delete();
    	 $notification=array(
                 'messege'=>'Category Successfully Deleted',
                 'alert-type'=>'success'
                       );
            return Redirect()->back()->with($notification);
    }

    public function EditCategory($id)
    {
    	$category=DB::table('categories')->where('id',$id)->first();
    	return view('admin.category.edit_category',compact('category'));
    }

    public function UpdateCategory(Request $request,$id)
    {
    	$validatedData = $request->validate([
        'category_name' => 'required|max:55',
        ]);
         $data=array();
         $data['category_name']=$request->category_name;
         $update= DB::table('categories')->where('id',$id)->update($data);
        if ($update) {
        	$notification=array(
                 'messege'=>'Category Successfully Updated',
                 'alert-type'=>'success'
                       );
            return Redirect()->route('categories')->with($notification);
        }else{
        	$notification=array(
                 'messege'=>'Nothing to update',
                 'alert-type'=>'success'
                       );
            return Redirect()->route('categories')->with($notification);
        }
    }

    // Brands Operation =====================
    public function brand(){
        $brand = Brand::all();
        return view('admin.category.brand',compact('brand'));
    }

    public function storebrand(Request $request){
        $validatedData = $request->validate([
        'brand_name' => 'required|unique:brands|max:200',
        'brand_logo'=>'required',
         ]);

        $data = array();
        $data['brand_name']=$request->brand_name;
         
        $image=$request->file('brand_logo');
        if ($image) {
             $image_name = hexdec(uniqid());
             $ext = strtolower($image->getClientOriginalExtension());
             $image_full_name = $image_name.'.'.$ext;
             $upload_path = 'public/media/brand/';
             $image_url = $upload_path.$image_full_name;
             $success=$image->move($upload_path,$image_full_name);
             $data['brand_logo']=$image_url;
             
             DB::table('brands')->insert($data);
             
             $notification=array(
                 'messege'=>'Brand Inserted Fully Done',
                 'alert-type'=>'success'
                       );
            return Redirect()->back()->with($notification);
        }else{
            DB::table('brands')->insert($data);
            
           $notification=array(
                 'messege'=>'Brand Inserted Done',
                 'alert-type'=>'success'
                       );
            return Redirect()->back()->with($notification);

        }
 
    }

    public function DeleteBrand($id){
        $brand = DB::table('brands')->where('id',$id)->first();
       // return response()->json($brand);
        $brand_logo = $brand->brand_logo;
        //return response()->json($brand_logo);
        unlink($brand_logo);

        DB::table('brands')->where('id',$id)->delete();

        $notification=array(
                 'messege'=>'Brand Successfully Deleted',
                 'alert-type'=>'success'
                );
            return Redirect()->back()->with($notification);
    }

    public function EditBrand($id){
        $brand = DB::table('brands')->where('id',$id)->first();
        return view('admin.category.edit_brand',compact('brand'));
    }

    public function UpdateBrand(Request $request,$id){
        $validatedData = $request->validate([
        'brand_name' => 'required:brands|max:200',
         ]);

        $data = array();
        $data['brand_name']=$request->brand_name;

        $brand = DB::table('brands')->where('id',$id)->first();
        $old_logo = $brand->brand_logo;

        $image=$request->file('brand_logo');
        if ($image) { 

             unlink($old_logo);

             $image_name = hexdec(uniqid());
             $ext = strtolower($image->getClientOriginalExtension());
             $image_full_name = $image_name.'.'.$ext;
             $upload_path = 'public/media/brand/';
             $image_url = $upload_path.$image_full_name;
             $success=$image->move($upload_path,$image_full_name);
             $data['brand_logo']=$image_url;
             
             DB::table('brands')->where('id',$id)->update($data);
             
             $notification = array(
                'message'=>'Successfuly brands Updated',
                'alert-type'=>'success'
            );
            return Redirect()->route('brands')->with($notification);
        }else{
            $data['brand_logo'] = $old_logo;
            DB::table('brands')->where('id',$id)->update($data);
            $notification = array(
                'message'=>'Successfuly brand Updated Without Image',
                'alert-type'=>'success'
            );
            return Redirect()->route('brands')->with($notification);

        }
    }

    //Sub Category Operation

    public function subcategory(){
        $category = DB::table('categories')->get();
        $subcategory = DB::table('subcategories')
                    ->join('categories','subcategories.category_id','categories.id')
                    ->select('subcategories.*','categories.category_name')
                    ->get();
        return view('admin.category.subcategory',compact('category','subcategory'));
        //return response()->json($category);
    }

    public function storesubcategory(Request $request){
        $validatedData = $request->validate([
        'subcategory_name' => 'required:subcategories|max:55',
        ]);

        // $data=array();
        // $data['category_name']=$request->category_name;
        // DB::table('categories')->insert($data);

        $subcategory = new Subcategory();
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->category_id = $request->category_id;
        $subcategory->save();
        $notification=array(
                 'messege'=>'Sub Category Insert Done',
                 'alert-type'=>'success'
                       );
            return Redirect()->back()->with($notification);
    }

    public function DeleteSubcategory($id){
        $subcategory = DB::table('subcategories')->where('id',$id)->delete();
        $notification=array(
                 'messege'=>'Sub Category Deleted Done',
                 'alert-type'=>'success'
                       );
            return Redirect()->back()->with($notification);
    }

    public function EditSubcategory($id){
        $category = DB::table('categories')->get();
        $subcategory = DB::table('subcategories')
                    ->join('categories','subcategories.category_id','categories.id')
                    ->select('subcategories.*','categories.category_name')
                    ->where('subcategories.id',$id)
                    ->first();
        
        return view('admin.category.edit_subcategory',compact('category','subcategory'));
    }

    public function UpdateSubcategory(Request $request,$id){
        $validatedData = $request->validate([
        'subcategory_name' => 'required:subcategories|max:55',
        ]);

        $data=array();
        $data['subcategory_name']=$request->subcategory_name;
        $data['category_id']=$request->category_id;
        DB::table('subcategories')->where('id',$id)->update($data); 

        $notification=array(
                 'messege'=>'Sub Category Updated Done',
                 'alert-type'=>'success'
                       );
            return Redirect()->route('subcategories')->with($notification);
    }

}
