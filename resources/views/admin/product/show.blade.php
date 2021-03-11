@extends('admin.admin_layouts')

@section('admin_content')
 <!-- ########## START: MAIN PANEL ########## -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous">

  <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href=" ">Product</a>
        <span class="breadcrumb-item active">Product Details</span>
      </nav>

      <div class="sl-pagebody">
          <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Product Information Form
              <a href="{{route('all.product')}}" class="btn btn-sm btn-success" style="float: right;"  >All Product</a>
            </h6>
            <p class="mg-b-20 mg-sm-b-30">Product Infomation Details</p> 
              <div class="form-layout">
                <div class="row mg-b-25">
                 <div class="col-lg-4">
                  <div class="form-group">
                  <label class="form-control-label">Product Name:</label>
                  <br>
                  <strong>{{$product->product_name}}</strong> 
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Product Code:  </label>
                  <br>
                  <strong>{{$product->product_code}}</strong> 
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Quantity:</label>
                  <br>
                  <strong>{{$product->product_quantity}}</strong> 
                </div>
              </div><!-- col-4 -->
              
              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Category: </label>
                  <br>
                  <strong>{{$product->category_name}}</strong>
                </div>
              </div><!-- col-4 -->
 

              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Sub Category:  </label>
                  <br>
                  <strong>{{$product->subcategory_name}}</strong>
                </div>
              </div><!-- col-4 -->


              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Brand:  </label>
                  <br>
                  <strong>{{$product->brand_name}}</strong>
                 </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Product Size: <span class="tx-danger">*</span></label>
                    <br>
                  <strong>{{$product->product_size}}</strong>
                  </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Product Color: <span class="tx-danger">*</span></label><br>
                  <strong>{{$product->product_color}}</strong>
                  </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Selling Price <span class="tx-danger">*</span></label>
                    <br>
                  <strong>{{$product->selling_price}}</strong>
                  </div>
                </div><!-- col-4 -->
                <div class="col-lg-12">
                  <div class="form-group">
                    <label class="form-control-label">Product Details: </label>
                     <br>
                  <strong>{{$product->product_details}}</strong>
                  </div>  
                </div>
                <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Video Link : </label>
                   <br>
                  <strong>{{$product->video_link}}</strong>
                  </div>  
                 </div>
              <div class="col-lg-4">
                <lebel>Image One (Main Thumbnail)<span class="tx-danger">*</span></lebel> <br>  
                <img src="{{URL::to($product->image_one)}}" style="height: 100px;width: 120px" id="one" >
              
              </div>
               
               <div class="col-lg-4">
                <lebel>Image Two  </lebel><br>   
                <img src="{{URL::to($product->image_two)}}" style="height: 100px;width: 120px" id="one" >
               
              </div>
               <div class="col-lg-4">
                <lebel>Image Three<span class="tx-danger">*</span></lebel> <br>  
                <img src="{{URL::to($product->image_three)}}" style="height: 100px;width: 120px" id="one" >
             
              </div>
            </div>
           <hr>
              <div class="row">
                <div class="col-lg-4">
                  <label class="">
                    @if($product->main_slider == 1)
                     <span class="badge badge-success">Active</span>
                    @else
                    <span class="badge badge-danger">Inactive</span>
                    @endif 
                     <span>Main Slider</span>
                   </label>
                </div>
                <div class="col-lg-4">
                  <label class=" ">
                  @if($product->hot_deal == 1)
                     <span class="badge badge-success">Active</span>
                    @else
                    <span class="badge badge-danger">Inactive</span>
                    @endif 
                  <span>Hot Deal</span>
                   </label>
                </div>
                <div class="col-lg-4">
                  <label class=" ">
                    @if($product->best_rated == 1)
                     <span class="badge badge-success">Active</span>
                    @else
                    <span class="badge badge-danger">Inactive</span>
                    @endif 
                    <span>Best Rated</span>
                  </label>
                </div>
                <div class="col-lg-4">
                  <label class=" ">
                   @if($product->trend == 1)
                     <span class="badge badge-success">Active</span>
                    @else
                    <span class="badge badge-danger">Inactive</span>
                    @endif 
                  <span>Trend Product</span>
                </label>
                </div>
                <div class="col-lg-4">
                  <label class=" ">
                   @if($product->mid_slider == 1)
                     <span class="badge badge-success">Active</span>
                    @else
                    <span class="badge badge-danger">Inactive</span>
                    @endif 
                  <span>Mid Slider</span>
                </label>
                </div>
                <div class="col-lg-4">
                  <label class=" ">
                     @if($product->hot_new == 1)
                     <span class="badge badge-success">Active</span>
                    @else
                    <span class="badge badge-danger">Inactive</span>
                    @endif 
                    <span>Hot New</span>
                  </label>
                </div>

                <div class="col-lg-4">
                  <label class=" ">
                     <span class="badge badge-success">Active</span>
                    <span>Buy One Get One</span>
                  </label>
                </div>
                 
            </div> 
            <br>  
          </div><!-- form-layout --> 
          </div><!-- card -->
        
      </div>
  </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
 
@endsection
