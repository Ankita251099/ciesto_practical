@extends('layouts.master')
@section('title','Force Update')

@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="card-title">Force Update</h4>
  </div>
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
    <form method="post" action="{{route('forceUpdate.add')}}">
      @csrf
      <input type="hidden" name="hidden_id" id="hidden_id" value="{{isset($versions->id)? $versions->id :'0'}}">
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>Version</label>
      
            <input type="text" class="form-control numbers" name="version" id="txt_question" value="{{isset($versions->id)? $versions->version :''}}"  placeholder="Version">
          @error('version')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>Url</label>
      
            <input type="text" class="form-control " name="url" id="txt_question" value="{{isset($versions->id)? $versions->url :''}}"  placeholder="Url">
          @error('url')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>

    </form>
  </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
  $(document).ready(function(){
    $('.alert-success').fadeIn().delay(3000).fadeOut();
  });
  $('.numbers').keyup(function () { 
    this.value = this.value.replace(/[^0-9\.]/g,'');
  });

</script>
@endsection
