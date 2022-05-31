@extends('layouts.master') 
@section('title','Helpdesk')

@section('content')

<div class="card">
  <div class="card-header">
    <h4 class="card-title">Help Desk</h4>
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
    <div class="row">
      <label>Status:</label>
    </div>
    <div class="row">

     <div class="form-group col-md-2">
                       <select name="status" required="" id="status_active" class="select2 form-control status">
                           <option  selected="" value="">~~SELECT~~</option>
                            <option value="open">Open</option>
                           <option value="close">Close</option>
                       </select>
                    </div>
                     <div class="form-group col-md-2">
                      
                  <button type="button" class="btn btn-danger btn-lg filter">Filter</button>
                    </div>
    </div>
    <div class="helpdesk_table_dynamic">
      @include('helpdesk.helpdesk_table')      
    </div>
  </div>
  
</div>
<input type="hidden" name="status_value" id="status_value" >

@endsection
@section('script')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script> -->
<script type="text/javascript">
 $(document).ready(function(){
    $('.alert-success').fadeIn().delay(3000).fadeOut();
      });


  $(function() {
    $('#toggle-event').change(function() {
      $('#console-event').html('Toggle: ' + $(this).prop('checked'))
    })
  })


 $(function() {
    $(document).on('change', '.toggle-class', function() {

        // alert('dds');
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('helpdesk.change_status') }}',
            data: {'status': status, 'id': id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
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
            url: "{{ route('helpdesk.status_data') }}",
            data: {
              "data":data,
            },        
            success: function (data)
            {        
            $('.helpdesk_table_dynamic').html(data.data);
               $('#example').DataTable();   
                }

                });
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

</script>
@endsection