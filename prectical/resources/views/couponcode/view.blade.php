@extends('layouts.master') 
@section('title','Coupon Code')

@section('content')

<div class="card">
  <div class="card-header">
    <h4 class="card-title">Coupon Code</h4>
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
        <a href="{{route('code.create')}}" type="button" style="float: right;" class="btn btn-primary "> Add Coupon Code</a>
      </div>
    </div>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Coupon Name</th>
          <th scope="col">Coupon Amount</th>
          <th scope="col">Action</th>
          
        </tr>
      </thead>
      <tbody>
        @php
          $no=1
        @endphp
       @if(count($codes)>0)
        @foreach($codes as $code)
        <tr>
          <th scope="row">{{$no}}</th>
          <td>{{$code->coupon_name}}</td>
          <td>₹ {{$code->amount}}</td>
          <td>
            <a class="badge badge-success shadow-success" href="{{route('code.edit',$code->id)}}" >
                                             <i class="fa fa-pencil-square-o" ></i> </a>
                                             <a class="badge badge-danger shadow-danger this_destroy"  data-url="{{route('code.delete',$code->id)}}" ><i class="fa fa-trash" style="color: white;"></i> </a>
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