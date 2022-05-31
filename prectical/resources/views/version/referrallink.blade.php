@extends('layouts.master')
@section('title','Referral Link')

@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="card-title">Referral Link</h4>
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
    <form method="post" action="{{route('referrallink.add')}}">
      @csrf
      <input type="hidden" name="hidden_id" id="hidden_id" value="{{isset($link->id)? $link->id :'0'}}">
     
      
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>Referral link</label>
      
            <input type="text" class="form-control " name="referral_link" id="txt_question" value="{{isset($link->id)? $link->referral_link :''}}"  placeholder="Referral link">
          @error('referral_link')
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
