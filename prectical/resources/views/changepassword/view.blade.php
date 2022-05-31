@extends('layouts.master')
@section('title','Change Password')

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
    <h4 class="card-title">Change Password</h4>

  </div>
  <div class="card-body">
    <form method="post" action="{{route('changepassword.update')}}" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="hidden_id" id="hidden_id" value="{{isset($popups->id)? $popups->id :'0'}}">
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>Old password</label>
          <input type="password" class="form-control " name="oldpassword" value="{{old('oldpassword')}}" placeholder="Old Password">
          @error('oldpassword')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group col-md-12">
          <label>New Password</label>
          <input type="password" class="form-control " name="password" value="" placeholder="New Password">
          
          @error('password')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
          
        </div>
        <div class="form-group col-md-12">
          <label>Confirm Password</label>
          <input type="password" class="form-control " name="password_confirmation" value="" placeholder="Confirm Password">
          
          @error('password_confirmation')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
          
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="{{route('changepassword.index')}}" type="button" class="btn btn-danger">Cancel</a>

    </form>
  </div>
</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
     $(document).ready(function(){
    $('.alert-success').fadeIn().delay(3000).fadeOut();
    $('.alert-danger').fadeIn().delay(3000).fadeOut();
      });
</script>
@endsection
