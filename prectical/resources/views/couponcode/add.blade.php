@extends('layouts.master')
@section('title',' Add Coupon Code')

@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="card-title">Add Coupon Code</h4>
  </div>
  <div class="card-body">
    <form method="post" action="{{route('code.add')}}">
      @csrf
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>Coupon Code Name:</label>
          <input type="text" class="form-control" name="coupon_name"  placeholder=" Enter Coupon Code Name">
          @error('coupon_name')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>Coupon Code Amount:</label>
          <input type="text" class="form-control numbers" id="amount" name="amount" placeholder="Enter Coupon Code Amount">
          @error('amount')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="{{route('code.index')}}" type="button" class="btn btn-danger">Cancel</a>

    </form>
  </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $('.numbers').keyup(function () { 
    this.value = this.value.replace(/[^0-9\.]/g,'');
});
   
</script>
@endsection