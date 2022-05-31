@extends('layouts.master') 
@section('title','Notifications')
@section('content')

<div class="card">
  <div class="card-header">
    <h4 class="card-title">Notification</h4>
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
        <a href="{{route('notification.create')}}" type="button" style="float: right;" class="btn btn-primary "> Add Notification</a>
      </div>
    </div>
    <table class="table table-bordered" id="example">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Type</th>
          <th scope="col">Image</th>
          <th scope="col">Message</th>
          <th scope="col">Action</th>
          
        </tr>
      </thead>
      <tbody>
        @php
          $no=1
        @endphp
         @if(count($notifications) > 0)
        @foreach($notifications as $notification)
        <tr>
          <th scope="row">{{$no}}</th>
          <td>
            @if(!is_null($notification->userdetails))
            {{$notification->userdetails->user_name}}
            @else
            @endif
          </td>
          <td>{{$notification->type}}</td>
          <td>
            @if(!is_null($notification->image))
            <img width="100px" src="{{asset('upload/notification/'.$notification->image)}}">
            @else
            @endif
          </td>
          <td>{{$notification->message}}</td>
          <td>
            <a class="badge badge-success shadow-success" href="{{route('notification.edit',$notification->id)}}" 
                                            >
                                             <i class="fa fa-pencil-square-o" ></i> </a>
                                             <a class="badge badge-danger shadow-danger this_destroy"  data-url="{{route('notification.delete',$notification->id)}}" ><i class="fa fa-trash-alt"></i> </a>
                                             <a class="badge badge-danger shadow-info"  href="{{route('send_notification',$notification->id)}}" ><i class="fa fa-mail-forward"></i> </a>
          </td>
        </tr>
        @php
          $no++
        @endphp
        @endforeach
        @else
        <tr>
           <td colspan="6" class="text-center">No Record Found</td>
        </tr>
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