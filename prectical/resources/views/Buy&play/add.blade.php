  @extends('layouts.master')
@section('title',' Add Buy&play')

  @section('content')
  <div class="card ">
    <div class="card-header">
      <h4 class="card-title">Add Spin</h4>
    </div>
    <div class="card-body">   
      
      <div class="form-horizontal">
        <form method="post" action="{{route('spin.add')}}">
          @csrf
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Spin Amount</label>
            <div class="col-sm-3">
              <div class="input-group-prepend">
                  <span class="input-group-text" >₹</span>
              <input type="text" class="form-control" name="amount" placeholder="Amount">
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
              <input type="text" class="form-control" name="discount_amount" placeholder="Discounted Amount">
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
              <input type="text" class="form-control" name="hours" placeholder=" Hours">
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
              <div class="input-group">
              <input type="text" class="form-control" name="price" placeholder="Price">
                <div class="input-group-prepend">
                  <span class="input-group-text" >₹</span>
                </div> 
              </div>
              @error('price')
              <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror 
            </div>
            <div class="col-sm-2">
                <div class="input-group">
              <input type="text" class="form-control" name="price1" placeholder="Price">
                  <div class="input-group-prepend">
                  <span class="input-group-text" >₹</span>
                </div> 
              </div>
              @error('price')
              <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-sm-2">
                <div class="input-group">
              <input type="text" class="form-control" name="price2" placeholder="Price">
              <div class="input-group-prepend">
                  <span class="input-group-text" >₹</span>
                </div> 
              </div>
              @error('price')
              <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-sm-2">
                <div class="input-group">
              <input type="text" class="form-control" name="price3" placeholder="Price">
              <div class="input-group-prepend">
                  <span class="input-group-text" >₹</span>
                </div> 
              </div>
              @error('price')
              <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-sm-2">
                <div class="input-group">
              <input type="text" class="form-control" name="price4" placeholder="Price">
              <div class="input-group-prepend">
                  <span class="input-group-text" >₹</span>
                </div> 
              </div>
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
                <div class="input-group">
              <input type="text" class="form-control" name="price5" placeholder="Price">
              <div class="input-group-prepend">
                  <span class="input-group-text" >₹</span>
                </div> 
              </div>
              @error('price')
              <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-sm-2">
                <div class="input-group">
              <input type="text" class="form-control" name="price6"  placeholder="Price">
              <div class="input-group-prepend">
                  <span class="input-group-text" >₹</span>
                </div> 
              </div>
              @error('price')
              <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-sm-2">
                <div class="input-group">
              <input type="text" class="form-control" name="price7" placeholder="Price">
              <div class="input-group-prepend">
                  <span class="input-group-text" >₹</span>
                </div> 
              </div>
              @error('price')
              <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-sm-2">
                <div class="input-group">
              <input type="text" class="form-control" name="price8" placeholder="Price">
              <div class="input-group-prepend">
                  <span class="input-group-text" >₹</span>
                </div> 
              </div>
              @error('price')
              <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-sm-2">
                <div class="input-group">
              <input type="text" class="form-control" name="price9" placeholder="Price">
              <div class="input-group-prepend">
                  <span class="input-group-text">₹</span>
                </div> 
              </div>
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
              <input type="text" class="form-control" name="count"  placeholder="Chance">
              @error('count')
              <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-sm-2">
              <div class="input-group">
                <input type="text" class="form-control" name="per"  placeholder="Percentage">
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
          <div class="form-group row">
            <div class="col-sm-2"></div>
            <div class="col-sm-4">
              <input type="text" class="form-control"name="count2"  placeholder="Chance">
              @error('count')
              <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-sm-2">
              <div class="input-group">
                <input type="text" class="form-control" name="per2" placeholder="Percentage" >
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

          <div class="form-group row">
            <div class="col-sm-2"></div>
            <div class="col-sm-4">
              <input type="text" class="form-control"name="count3"  placeholder="Chance">
              @error('count')
              <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-sm-2">
              <div class="input-group">
                <input type="text" class="form-control" name="per3" placeholder="Percentage" >
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
        </form>
      </div>
    </div>
  </div>
  @endsection
