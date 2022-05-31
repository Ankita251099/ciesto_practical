@extends('layouts.master') 
@section('title','Spin View')

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
       <!--  
        <button  type="button" class="btn btn-danger delete_all mr-2 " data-url="{{route('multiple.delete')}}" id="delete_all" disabled="disabled" style="float: right; " >Delete All Selected</button> -->

      </div>
    </div>

    <table class="table table-bordered">
      <thead>
        <tr>
         <!--  <th class="text-center"><input type="checkbox" class="checkAll" id="master" name="master" value="y" > -->

          <!-- </th> -->
          <th scope="col">#</th>
          <th scope="col">Spin Amount</th>
          <th scope="col">Spin Price</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @php
        $no=1
        @endphp
        @if(count($spins) > 0)
        @foreach($spins as $spin)
        <tr>
          <!-- <td class="text-center">
            <input name='id[]' type="checkbox" class="sub_chk" data-id="{{$spin->id}}">
            
          </td> -->
          <td>{{$no}}</td>
          <td>₹ {{$spin->amount}}</td>
          <td>{{$spin->price}} , {{ $spin->price1}} , {{$spin->price2}} , {{$spin->price3}} , {{$spin->price4}} , {{$spin->price5}} , {{$spin->price6}} , {{$spin->price7}} , {{$spin->price8}} , {{$spin->price9}}</td>
          <td>
            <a class="badge badge-success shadow-success" href="{{route('spin.edit',$spin->id)}}"> 
              
             <i class="fa fa-pencil-square-o"></i> </a>
             
             <a class="badge badge-danger shadow-danger this_destroy"  data-url="{{route('spin.delete',$spin->id)}}" ><i class="fa fa-trash" style="color: white;"></i> </a>
           </td>
         </tr>
         @php
         $no++
         @endphp
         @endforeach
         @else
         <tr>
           <td colspan="4" class="text-center">No Record Found</td>
         </tr>
         @endif
       </tbody>

     </table>
     
   </div>

 </div>

 @endsection
 @section('script')
 
 <script type="text/javascript">

  $(".checkAll").on('click',function () {
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
  

  
 //  $(document).ready(function () {
   
 //   $('#master').click(function() {
     
 //    if ($('#delete_all').is(':disabled')) {
 //      $('#delete_all').removeAttr('disabled');
 //    } else {
 //      $('#delete_all').attr('disabled', 'disabled');
 //    }
 //  });
   
 //   $('#master').on('click', function(e) {

    
    
 //     if($(this).is(':checked',true))  
 //     {
 //      $(".sub_chk").prop('checked', true);  
 //    } 
 //    else 
 //    {  
 //      $(".sub_chk").prop('checked',false);  
 //    }  
 //  });


 //   $('.delete_all').on('click', function(e) {


 //    var allVals = [];  
 //    $(".sub_chk:checked").each(function() {  
 //      allVals.push($(this).attr('data-id'));
 //    });  

 //            // alert('data-id');
 //            if(allVals.length <=0)  
 //            {  
 //              alert("Please select row.");  
 //            }  else {  

              
 //              var check = confirm("Are you sure you want to delete this row?");  
 //              if(check == true){  


 //                var join_selected_values = allVals.join(","); 


 //                $.ajax({
 //                  url: $(this).data('url'),
 //                  type: 'get',
 //                  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
 //                  data: 'ids='+join_selected_values,
 //                  success: function (data) {
 //                    if (data['success']) {
 //                      $(".sub_chk:checked").each(function() {  
 //                        $(this).parents("tr").remove();
 //                      });
 //                      alert(data['success']);
 //                    } else if (data['error']) {
 //                      alert(data['error']);
 //                    } else {
 //                      alert('Whoops Something went wrong!!');
 //                    }
 //                         // location.reload();


 //                       },
 //                       error: function (data) {
 //                        alert(data.responseText);
 //                      }
 //                    });


 //                $.each(allVals, function( index, value ) {
 //                  $('table tr').filter("[data-row-id='" + value + "']").remove();
 //                  location.reload();
                  

 //                });
                
 //              }  
 //            }  
 //          });
 // }); 

//
</script>
@endsection