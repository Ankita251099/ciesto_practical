@extends('layouts.master')
@section('title',' Edit Buy&play')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Edit Spin</h4>
    </div>
    <div class="card-body">   

        <div class="form-horizontal">
            <form method="post" action="{{route('spin.update', $spins->id)}}">
                @csrf

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Spin Amount</label>
                    <div class="col-sm-3">
                       <div class="input-group-prepend">
                  <span class="input-group-text" >₹</span>
                        <input type="text" class="form-control" name="amount" value="{{$spins->amount}}"placeholder="Amount">
                      </div>
                        @error('amount')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
                    </div>
                </div>
                <div class="form-group row">
            <label class="col-sm-2 col-form-label">Discounted Amount</label>
            <div class="col-sm-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" >₹</span>
              <input type="text" class="form-control" name="discount_amount" value="{{$spins->discount_amount}}" placeholder="Discounted Amount">
                </div> 
              @error('discount_amount')
              <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Hours</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="hours" value="{{$spins->hours}}" placeholder=" Hours">
              @error('hours')
              <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label">Spin Price</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="price" value="{{$spins->price}}" placeholder="Price">
                        @error('price')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="price1" value="{{$spins->price1}}" placeholder="Price">
                      @error('price')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror  
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="price2" value="{{$spins->price2}}" placeholder="Price">
                        @error('price')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="price3" value="{{$spins->price3}}"placeholder="Price">
                      @error('price')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror  
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="price4" value="{{$spins->price4}}" placeholder="Price">
                      @error('price')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror  
                    </div>

                </div>
                <div class="form-group row ">
                  <div class="col-sm-2"></div>                          
                  
                  <div class="col-sm-2">
                    <input type="text" class="form-control" name="price5" value="{{$spins->price5}}" placeholder="Price">
                    @error('price')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="price6" value="{{$spins->price6}}" placeholder="Price">
                   @error('price')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror 
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="price7" value="{{$spins->price7}}" placeholder="Price">
                   @error('price')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror 
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="price8" value="{{$spins->price8}}" placeholder="Price">
                    @error('price')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="price9" value="{{$spins->price9}}" placeholder="Price">
                  @error('price')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror  
                </div>
            </div>
            
            <div class="form-group row ">
                <label class="col-sm-2 col-form-label">Chance</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" value="{{$spins->count}} " name="count"  placeholder="">
                  @error('count')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror  
                </div>
                <div class="col-sm-2">
                    <div class="input-group">
                        <input type="text" class="form-control"value="{{$spins->per}}" name="per" >
                        <div class="input-group-prepend" >
                          <span class="input-group-text" >%</span>
                      </div>

                  </div>
                  @error('per')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
              </div>
          </div>

          <div class="form-group row">
              <div class="col-sm-2"></div>
              <div class="col-sm-4">
                  <input type="text" class="form-control" value="{{$spins->count2}}" name="count2"  placeholder="Chance">
                  @error('count')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
              </div>
              <div class="col-sm-2">
                    <div class="input-group">
                        <input type="text" class="form-control"value="{{$spins->per2}}" name="per2">
                        <div class="input-group-prepend" >
                          <span class="input-group-text" >%</span>
                      </div>

                  </div>
                  @error('per')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
              </div>
          </div>
          <div class="form-group row">
              <div class="col-sm-2"></div>
              <div class="col-sm-4">
                  <input type="text" class="form-control" value="{{$spins->count3}}" name="count3" placeholder="Chance">
                  @error('count3')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
              </div>
              <div class="col-sm-2">
                    <div class="input-group">
                        <input type="text" class="form-control" name="per3" value="{{$spins->per3}}">
                        <div class="input-group-prepend">
                          <span class="input-group-text" >%</span>
                      </div>

                  </div>
                  @error('per')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
              </div>
          </div>

          <div class="form-group row ">
            <div class="col-md-12 text-right">
                <button type="submit"  class="btn btn-primary btn-lg">Save</button>
                <a href="{{route('spin.view')}}" type="submit"  class="btn btn-primary btn-lg">Cancel</a>
            </div>

        </div>
        <input type="hidden" name="spinid" value="{{$spins->id}}">
    </form>
</div>
</div>
</div>
@endsection
