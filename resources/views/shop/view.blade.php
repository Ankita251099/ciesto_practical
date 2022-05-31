@extends('layouts.master') 
@section('title','Shop')

@section('content')

<div class="card">
  <div class="card-header">
    <h4 class="card-title">Shop</h4>
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
  



    <div class="row pb-2">
     
      <div class="col-12">   
       <a href="{{asset('uploads/download/shop_csv.xls')}}" download style="float: right; margin-left: 5px;" class="btn btn-success "> Download</a>
        <button  data-toggle="modal" data-target="#exampleModal" style="float: right; margin-left: 5px;" class="btn btn-danger "> Import</button>
        <a href="#"  type="button" style="float: right; margin-left: 5px;" class="btn btn-warning "> Export</a>

        <a href="{{route('shop.create')}}" type="button" style="float: right; margin-left: 5px;" class="btn btn-primary "> Add Shop</a>
      </div>
    </div>
    <table class="table table-bordered" id="example">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Shop Name</th>
          <th scope="col">Image</th>
          <th scope="col">Address</th>
          <th scope="col">Email</th>
          <th scope="col">Action</th> 
        </tr>
      </thead>
      <tbody>
        @php
          $no=1
        @endphp
       @if(count($shops)>0)
        @foreach($shops as $shop)
        <tr>
          <th scope="row">{{$no}}</th>
          <td>{{$shop->shop_name}}</td>
          <td>
            {{$shop->image}}
    
          </td>
          <td>{{$shop->address}}</td>
          <td>{{$shop->email}}</td>
          <td>
            <a class="badge badge-success shadow-success" href="{{route('shop.edit',$shop->id)}}" 
                                            >
                                             <i class="fa fa-pencil-square-o" ></i> </a>
                                             <a class="badge badge-danger shadow-danger this_destroy"  data-url="{{route('shop.delete',$shop->id)}}" ><i class="fa fa-trash"></i> </a>
                                             
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
  </div>
  
</div>




<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('shop.import')}}" method="post" enctype="multipart/form-data">
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