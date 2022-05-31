@extends('layouts.master')
@section('title',' Add Shops')

@section('content')

<div class="card">
  <div class="card-header">
    <h4 class="card-title">Add Shop</h4>
  </div>
  <div class="card-body">
    <form method="post" action="{{route('shop.add')}}" enctype="multipart/form-data">
      @csrf
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>Shop Name</label>
          <input type="text" class="form-control" name="shop_name" id="txt_question" placeholder="Question">
          @error('shop_name')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
       <div class="form-row">
        <div class="form-group col-md-12">
          <label>Image</label>
          <input type="file" class="form-control" name="image" id="answer" placeholder="Image">
          @error('image')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>Address</label>
          <input type="text" class="form-control" name="address" id="answer" placeholder="Address">
          @error('Address')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>Email</label>
          <input type="text" class="form-control" name="email" id="answer" placeholder="Email">
          @error('email')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="{{route('shop.index')}}" type="button" class="btn btn-danger">Cancel</a>

    </form>
  </div>
</div>
@endsection
