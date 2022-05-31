@extends('layouts.master') 
@section('title','Buy&play')

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')

<div class="card">
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
        <a href="{{route('spin.create')}}" type="button" style="float: right;" class="btn btn-primary "> Add Spin</a>
        <form method="post" action="{{route('multiple.delete')}}">
          @csrf
          <button  class="btn btn-danger delete_all mr-2" id="delete_all" style="float: right;" >Delete All Selected</button>

        </div>
      </div>

      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="text-center"><input type="checkbox" id="checkAll">

            </th>
            <th scope="col">Spin Amount</th>
            <th scope="col">Spin Price</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @php
          $no=1
          @endphp

          @foreach($spins as $spin)
          <tr>
            <td class="text-center">
                              <input name='id[]' type="checkbox" value="{{$spin->id}}">
                               
              </td>
              <td>₹{{$spin->amount}}</td>
              <td>{{$spin->price}} , {{ $spin->price1}} , {{$spin->price2}} , {{$spin->price3}} , {{$spin->price4}} , {{$spin->price5}} , {{$spin->price6}} , {{$spin->price7}} , {{$spin->price8}} , {{$spin->price9}}</td>
              <td>
                <a class="badge badge-success shadow-success" href="{{route('spin.edit',$spin->id)}}"> 

                 <i class="fa fa-pencil-square-o" ></i> </a>
                 <a class="badge badge-danger shadow-danger this_destroy"  data-url="{{route('spin.delete',$spin->id)}}" ><i class="fa fa-trash-o"></i> </a>
               </td>
             </tr>
             @php
             $no++
             @endphp
             @endforeach
           </tbody>

         </table>
       </form>
     </div>

   </div>

   @endsection
   @section('script')
   
   <script type="text/javascript">

    $("#checkAll").click(function () {
      $('input:checkbox').not(this).prop('checked', this.checked);
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

     // $(document).on('click','.delete_all', function() {

     // // {{route('multiple.delete')}}  
     //  // alert('asrf')
     //  // event.preventDefault();
        
     //       // let del_url = $(this).attr('data-url');

     //  var id= $(this).data('id');
     //      bootbox.confirm({
     //        message: "Are you sure to delete? ",
     //        buttons: {
     //          confirm: {
     //            label: 'Yes',
     //            className: 'btn-success'
     //          },
     //          cancel: {
     //            label: 'No',
     //            className: 'btn-danger'
     //          }
     //        },
     //        callback: function(result) {
     //          alert(result)
     //          if(result){
     //                    location.reload(del_url);
                       
     //                  }
     //                }
     //              });

     //    })

//      $(document).on('click','.delete_all', function() {
// //     
     // event.preventDefault();
//     var id = $(this).data('id');

//              alert('assd');

//     bootbox.confirm("Are you want to sure change the action", function(result) {
 
//        if(result){
//          // AJAX Request
//          $.ajax({
//            url: "multiple.delete",
//            type: 'post',
//            data: { id:id
                    
//                  },
//            success: function(response){

//              if(response == 1){
//                    location.reload();
                
//                    }

//                        }
//                      });
//        }
 
//     });
 
//   }); 
      </script>
      @endsection