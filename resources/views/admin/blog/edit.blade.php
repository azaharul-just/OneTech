@extends('admin.admin_layouts')

@section('admin_content')
 <!-- ########## START: MAIN PANEL ########## -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous">

  <div class="sl-mainpanel"> 
      <div class="sl-pagebody">
          <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Post Update Form
              <a href="{{route('all.blogpost')}}" class="btn btn-sm btn-success" style="float: right;"  >All Post</a>
            </h6>
            <p class="mg-b-20 mg-sm-b-30">Fill up the fields. The  <span class="tx-danger">*</span> fields are required</p>
          <form action="{{URL::to('update/post/'.$post->id)}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-layout">
                <div class="row mg-b-25">
                 <div class="col-lg-6">
                  <div class="form-group">
                  <label class="form-control-label">Post Title (English): <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="post_title_en" value="{{$post->post_title_en}}" >
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Post Title (Bangla) <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="post_title_bn" value="{{$post->post_title_bn}}">
                </div>
              </div><!-- col-4 -->
              
              
              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                  <select class="form-control select2" required="" data-placeholder="Choose Category" name="category_id">
                    <option label="Choose Category"></option>
                    @foreach($category as $row)
                    <option value="{{$row->id}}" <?php if($row->id==$post->category_id){echo "selected";}?> >{{$row->category_name_en}}</option>
                    @endforeach
                  </select>
                </div>
              </div><!-- col-4 -->
   
                <div class="col-lg-12">
                  <div class="form-group">
                    <label class="form-control-label">Post Details (English)<span class="tx-danger">*</span></label>
                    <textarea class="form-control" id="summernote" name="details_en">
                       {{$post->details_en}} 
                   </textarea>
                  </div>  
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <label class="form-control-label">Post Details (Bangla)<span class="tx-danger">*</span></label>
                     <textarea class="form-control" id="summernote1" name="details_bn">
                    {{$post->details_bn}}
                   </textarea>
                  </div>  
                </div>
                 
              <div class="col-lg-6">
                <lebel>Post Image : <span class="tx-danger">*</span></lebel>
                <label class="custom-file">
                <input type="file" id="file" class="custom-file-input" name="post_image" onchange="readURL(this);" accept="image">
                <span class="custom-file-control"></span>
                <img src="#" id="one" >
              </label>
              </div> 

              <div class="col-lg-6">
                <lebel>Post Old Image : <span class="tx-danger">*</span></lebel> 
                <img src="{{URL::to($post->post_image)}}" style="height: 80px;width: 100px">
                <input type="hidden" name="old_image" value="{{$post->post_image}}"> 
              </div>


              </div> 
              </div> 
              <br> 
                <div class="form-layout-footer">
                  <button class="btn btn-info mg-r-5" type="submit">Update Post</button> 
                </div><!-- form-layout-footer -->
              
            </form>
          </div><!-- form-layout -->
        </div><!-- card -->
    
  </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
 


<script type="text/javascript">
  function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#one')
                  .attr('src', e.target.result)
                  .width(80)
                  .height(80);
          };
          reader.readAsDataURL(input.files[0]);
      }
   }
</script> 
@endsection
