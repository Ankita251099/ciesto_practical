@extends('layouts.master')
@section('title','Withdraw Limit')

@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="card-title">Withdraw Limit</h4>
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
    <form method="post" action="{{route('withdraw.add')}}">
      @csrf
      <input type="hidden" name="hidden_id" id="hidden_id" value="{{isset($withdraws->id)? $withdraws->id :'0'}}">
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>Minimum Withdrawal Amount</label>
          <div class="input-group-prepend">
            <span class="input-group-text" >₹</span>
            <input type="text" class="form-control numbers" name="minimum" id="txt_question" value="{{isset($withdraws->id)? $withdraws->minimum :''}}"  placeholder="Minimum">
          </div> 
          @error('minimum')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>Maximum Withdrawal Amount</label>
          <div class="input-group-prepend">
            <span class="input-group-text" >₹</span>
            <input type="text" class="form-control numbers" name="maximum" id="answer" value="{{isset($withdraws->id)? $withdraws->maximum :''}}" placeholder="maximum">
          </div> 
          @error('maximum')
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
