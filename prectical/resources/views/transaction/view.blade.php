@extends('layouts.master') 
@section('title','Transaction')

@section('content')

<div class="card">
  <div class="card-header">
    <h4 class="card-title">Transaction</h4>
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
    <!-- <div class="row pb-2"> -->
       <div class="row ">
            <label>Status:</label>
          <div class="form-group col-md-2">
                <select name="status" required="" id="status_active" class="select2 form-control status">
                     <option  selected="" value="">~~SELECT~~</option>
                     <!-- <option value="pending">Pending</option> -->
                    <option value="success">Successful</option>
                     <option value="failed">Failed</option>
                </select>
          </div>
                    <div class="form-group col-md-2">
                      
                  <button type="button" class="btn btn-danger btn-lg filter">Filter</button>
                    </div>
        </div>
     
     <!--  <div class="col-12">                   
        <a href="{{route('transaction.create')}}" type="button" style="float: right;" class="btn btn-primary "> Add Transaction</a>
      </div> -->
   <!--  </div> -->
    <div class="transaction_table_dynamic">
      @include('transaction.transaction_table')
    </div>
  </div>
  
</div>
<input type="hidden" name="status_value" id="status_value" >

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.alert-success').fadeIn().delay(3000).fadeOut();
      });
   $('#example5').dataTable({
       
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

    $(document).on('click', '.this_verified',function() {
      // alert('sdsa');
            let status_url = $(this).attr('data-url');
            let id =$(this).attr('data-id');
            // alert(id);
            bootbox.confirm({
                message: "Are you want to sure paid the transaction?",
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
                    url: "{{ route('transaction.paid') }}",
                    data: { 
                        id:id,
                        status:'pending',
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
 
 $(document).on('click','.this_unpaid', function() {
  // alert('dsd');
            let status_url = $(this).attr('data-url');
            let id =$(this).attr('data-id');
            // alert(status_url);
            // alert(id);
            bootbox.confirm({
                message: "Are you want to sure unpaid the transaction?",
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
                    url: "{{ route('transaction.unpaid') }}",
                    data: { 
                        id:id,
                        status:'pending',
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
// alert(data);

  $.ajax({
    type: "GET",
    url: "{{ route('transaction.status_data') }}",
    data: {
      "data":data,
    },        
    success: function (data)
    {          
      $('.transaction_table_dynamic').html(data.data);
      $('#example').DataTable();

    }

  });
});

</script>
@endsection