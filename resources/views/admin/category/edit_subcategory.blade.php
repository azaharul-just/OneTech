@extends('admin.admin_layouts')
@section('admin_content')
  <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Sub Category Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
            <form method="post" action="{{URL::to('update/subcategory/'.$subcategory->id)}}">
              @csrf
              <div class="modal-body pd-20">
                <div class="form-group">
                  <label for="exampleInputEmail1">Sub Category Name</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$subcategory->subcategory_name}}" name="subcategory_name">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Category Name</label>
                  
                  <select class="form-control" name="category_id">
                    @foreach($category as $row)
                    <option value="{{$row->id}}" <?php if($row->id == $subcategory->category_id){echo "selected"; } ?> >{{$row->category_name}}</option>
                    @endforeach
                  </select>
                  
                </div>
              </div><!-- modal-body -->
              <div class="modal-footer">
                <button type="submit" class="btn btn-info pd-x-20">Update</button>
                
              </div>
            </form> 
        </div><!-- card -->
      </div><!-- sl-pagebody -->


<!--modal-->
        
@endsection