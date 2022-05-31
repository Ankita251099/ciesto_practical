@extends('layouts.master') 
@section('title','KYC Verification')

@section('content')

<div class="card">
  <div class="card-header">
    <h4 class="card-title">KYC Verification</h4>
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
      <div class="row ">
        <div class="form-group col-md-2">
                       <select name="status" required="" id="status_active" class="select2 form-control status">
                           <option  selected="" value="">~~SELECT~~</option>
                            <option value="padding">Padding</option>
                           <option value="rejected">Rejected</option>
                           <option value="verified">Verified</option>
                       </select>
                    </div>
                    <div class="form-group col-md-2">
                      
                  <button type="button" class="btn btn-danger btn-lg filter">Filter</button>
                    </div>
                  </div>

            <div class="example_table_dynamic">
                      @include('KycVerification.dynamictable')
                    </div>
 <!--  -->
     
</div>

<input type="hidden" name="status_value" id="status_value" >
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins-init/datatables.init.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $('.alert-success').fadeIn().delay(3000).fadeOut();
      });

 $(document).on('click','.this_destroy', function() {
            
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
  
 $(document).on('click','.this_verified', function() {

            let status_url = $(this).attr('data-url');
            let id =$(this).attr('data-id');
            // alert(user_id);
            bootbox.confirm({
                message: "Are you want to sure verified the documents?",
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
                    $.ajax({
                    type: "GET",
                    url: "{{ route('kyc.verified') }}",
                    data: { 
                        id:id,
                        status:'padding',
                    },
                    success: function(data){
              // console.log(data.success)
              location.reload()
            }
                    
                });
            } 
                }
            });
        })
 // $('.this_rejected').on('click', function() {
 $(document).on('click','.this_rejected', function() {

  // alert('dsd');
            let status_url = $(this).attr('data-url');
            let id =$(this).attr('data-id');
            // alert(status_url);
            // alert(id);
            bootbox.confirm({
                message: "Are you want to sure rejected the documents?",
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
                    $.ajax({
                    type: "GET",
                    url: "{{ route('kyc.rejected') }}",
                    data: { 
                        id:id,
                        status:'padding',
                    },
                     success: function(data){
              // console.log(data.success)
              location.reload()
            }
                    
                });
            } 
                }
            });
        })



 $('.status').on('change',function()
{
   var data = $(this).val();
    $("#status_value").val(data);
});

 $('.filter').on('click', function() {

  var data = $("#status_value").val();

        $.ajax({
            type: "GET",
            url: "{{ route('status_data') }}",
            data: {
              "data":data,
            },        
            success: function (data)
            {          
            $('.example_table_dynamic').html(data.data);
               $('#example').DataTable();
               
                }

                });
});

</script>

@endsection