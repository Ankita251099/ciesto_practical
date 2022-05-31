@extends('layouts.master') 
@section('title','Product')

@section('content')

<div class="card">
  <div class="card-header">
    <h4 class="card-title">Product</h4>
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
      
                  <form action="{{route('product.minmaxprice')}}" method="post">
                    @csrf
      <div class="row input-daterange pb-2">
                    
                <div class="col-md-4">
                   <input type="text" name="min_price" value="{{$min_price}}"  placeholder="min price" class="form-control min_price" >
                </div>
                <div class="col-md-4">
                    <input type="text" name="max_price" value="{{$max_price}}" placeholder="max price" class="form-control max_price" >
                </div>
              <button  type="submit" class="btn btn-danger "> Search</button>
              <a href="{{route('product.index')}}"  style="margin-left: 5px;" type="button" class="btn btn-info "> clear</a>

               
            </div>
                  </form>



    <div class="row pb-2">
     
      <div class="col-12">  
             <a href="{{asset('uploads/download/product_csv.xls')}}" download style="float: right;margin-left: 5px;" class="btn btn-success "> Download</a>
        <button  data-toggle="modal" data-target="#exampleModal" style="float: right; margin-left: 5px;" class="btn btn-danger "> Import</button>
        <a href="#"  type="button" style="float: right; margin-left: 5px;" class="btn btn-warning "> Export</a>                 
        <a href="{{route('product.create')}}" type="button" style="float: right; margin-left: 5px;" class="btn btn-primary "> Add Product</a>
      </div>
    </div>
    <table class="table table-bordered" id="example">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Product Name</th>
          <th scope="col">Price</th>
          <th scope="col">stock</th>
          <th scope="col">Shop Name</th>
          <th scope="col">video</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th> 
        </tr>
      </thead>
      <tbody>
        @php
          $no=1
        @endphp
       @if(count($products)>0)
        @foreach($products as $product)
        <tr>
          <th scope="row">{{$no}}</th>
          <td>{{$product->product_name}}</td>
          <td>
            {{$product->price}}
          </td>
          <td>{{$product->stock}}</td>
          <td>{{$product->shop_name['shop_name']}}</td>
          <td>{{$product->video}}</td>
          <td>
            @if($product->stock == 0)
            <span style=" background-color: #fd7e14; color: white ;padding: 2px;border-radius: 5px">Not Avaliable</span>
           
            @else
             <span style=" background-color: #0CC27E; color: white ;padding: 2px;border-radius: 5px">Avaliable </span>
            
            @endif
          </td>
          <td>
            <a class="badge badge-success shadow-success" href="{{route('product.edit',$product->id)}}" 
                                            ><i class="fa fa-pencil-square-o" ></i></a>
            <a class="badge badge-danger shadow-danger this_destroy"  data-url="{{route('product.delete',$product->id)}}" ><i class="fa fa-trash"></i> </a>
          </td>
        </tr>
        @php
          $no++
        @endphp
        @endforeach
        @else
        <td colspan="4" class="text-center">No Record Found</td>
        @endif

      </tbody>
      
    </table>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('product.import')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-row">
        <div class="form-group col-md-6">
          <input type="file" class="form-control" name="excelfile" id="example" placeholder="Image">
          @error('image')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Import</button>
      </div>
      </form>
    </div>
  </div>
</div>


  </div>
  
</div>

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.alert-success').fadeIn().delay(3000).fadeOut();
      });
   $('.this_destroy').on('click', function() {
            
            let del_url = $(this).attr('data-url');

            bootbox.confirm({
                message: "Are you sure to delete? ",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
                },
                callback: function(result) {
                    if(result){
                        location.replace(del_url);
                    }
                }
            });
        })
</script>
@endsection