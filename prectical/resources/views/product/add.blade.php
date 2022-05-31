@extends('layouts.master')
@section('title',' Add Products')

@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="card-title">Add Product</h4>
  </div>
  <div class="card-body">
    <form method="post" action="{{route('product.add')}}" enctype="multipart/form-data">
      @csrf
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>Name</label>
          <input type="text" class="form-control" name="product_name" id="txt_question" placeholder="Question">
          @error('product_name')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
       <div class="form-row">
        <div class="form-group col-md-12">
          <label>video</label>
          <input type="file" class="form-control" name="video" id="answer" placeholder="Image">
          @error('video')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>stock name</label>
           <select name="shop_id" id="shop_id" class="js-states form-control select2">
                    <option value="" selected="">~~SELECTED~~</option>
                   @foreach ($shops as $shop)
                <option value="{{ $shop->id }}">{{ucfirst($shop->shop_name)}}</option>
                @endforeach
                </select>    
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>price</label>
          <input type="text" class="form-control" name="price" id="answer" placeholder="price">
          @error('email')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
        <div class="form-row">
        <div class="form-group col-md-12">
          <label>Stock</label>
          <input type="text" class="form-control" name="stock" id="answer" placeholder="stock">
          @error('email')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="{{route('product.index')}}" type="button" class="btn btn-danger">Cancel</a>

    </form>
  </div>
</div>
@endsection
