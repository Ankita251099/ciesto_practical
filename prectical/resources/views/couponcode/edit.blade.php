@extends('layouts.master')
@section('title',' Edit Coupon Codes')

@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="card-title">Add Coupon Codes</h4>
  </div>
  <div class="card-body">
    <form method="post" action="{{route('code.update',$codes->id)}}">
      @csrf
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>Coupon Code</label>
          <input type="text" class="form-control" name="coupon_name" value="{{$codes->coupon_name}}" placeholder="coupon_name">
          @error('coupon_name')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="form-row">

        <div class="form-group col-md-12">
          <label>Coupon Code Amount</label>
          <input type="text" class="form-control" name="amount"  value="{{$codes->amount}}" placeholder="amount">
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
