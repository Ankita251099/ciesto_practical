@extends('layouts.master')
@section('title',' Popup Image')

@section('content')
  <div class="card-body">

 @if(Session::has('success'))
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ Session::get('success') }}
      </div>
      @endif
      @if(Session::has('message-error'))
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ Session::get('message-error') }}
      </div>
      @endif 
<div class="card">
  <div class="card-header">
    <h4 class="card-title">Popup Image</h4>

  </div>
  <div class="card-body">
    <form method="post" action="{{route('popupimage.add')}}" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="hidden_id" id="hidden_id" value="{{isset($popups->id)? $popups->id :'0'}}">
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>Image</label>
          <span class="text-danger"><strong>Note: Size = 1080*1920</strong></span>
          @if(empty($popups->image))
          <input type="file" class="form-control" value="{{isset($popups->id)? $popups->image :''}}" name="image">
          @else
          <input type="file" class="form-control" value="{{isset($popups->id)? $popups->image :''}}" name="image">
           <img class="image_hide " width="300px" id="my_image" src="{{asset('upload/image/'.$popups->image)}}">
           <a class="badge badge-danger shadow-danger this_destroy"  data-url="{{route('popupimage.delete',$popups->id)}}" ><i class="fa fa-trash" style="color: white;"></i> </a>
          @endif
          @error('image')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group col-md-12">
          <label>Link</label>
          <input type="text" class="form-control " name="link" value="{{isset($popups->id)? $popups->link :''}}" placeholder="Link">
          
          @error('link')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
          
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="{{route('popupimage.index')}}" type="button" class="btn btn-danger">Cancel</a>

    </form>
  </div>
</div>
</div>
@endsection
@section('script')
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.alert-success').fadeIn().delay(3000).fadeOut();
      });
   $('.this_destroy').on('click', function() {
            
            let del_url = $(this).attr('data-url');

            bootbox.confirm({
                message: "Are you sure to delete? ",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
                },
                callback: function(result) {
                    if(result){
                        location.replace(del_url);
                    }
                }
            });
        })
</script>
@endsection
