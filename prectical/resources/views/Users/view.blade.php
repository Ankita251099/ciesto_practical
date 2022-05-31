@extends('layouts.master') 
@section('title','User List')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="card">
  <div class="card-header">
    <h4 class="card-title">User List</h4>
  </div>
  <div class="card-body">
    <div class="row ">
      <label>KYC Status:</label>
      <div class="form-group col-md-2">
       <select name="status" required="" id="status_active" class="select2 form-control status">
         <option  selected="" value="">~~SELECT~~</option>
         <option value="padding">pending</option>
         <option value="rejected">Rejected</option>
         <option value="verified">Verified</option>
       </select>
     </div>
     <label>Date:</label>
     <div class="form-group col-md-2">
      <input type="date" id="date" name="date" class="form-control date">
    </div>
    <div class="form-group col-md-2">
      <button type="button" class="btn btn-danger btn-lg filter">Filter</button>
    </div>
  </div>
  <div class="user_table">
    @include('Users.user_table')
  </div>
  
</div>
<div class="modal fade" id="Addwallet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Addwalletlabel">Add Amount</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form method="POST" action="{{route('user.amountstore')}}" >
        @csrf

        <div class="modal-body">
          <div class="form-group row">
           <label class="col-sm-4 col-form-label">Wallet Amount:</label>
           <!-- <div class="col-sm-4"> -->
             <div class="input-group-prepend">
                  <span class="input-group-text" >₹</span>
            <input type="text" class="form-control numbers" name="balance" id="balance" placeholder="Amount">
            </div>
           <!-- </div> -->
         </div>                                
         
       </div>
       <input type="hidden" name="id" id="amout" >
     </form>
     <div class="modal-footer">
      <button type="submit" class="btn btn-primary addBtn ">Add</button>
    </div>
  </div>
</div>
</div>
<input type="hidden" name="status_value" id="status_value" >
<input type="hidden" name="date2" id="date2" >


@endsection
@section('script')

<script type="text/javascript">

  $(document).on('click','.addwallet',function(){



    var id = $(this).data('id');
  // alert(id);
  $("#amout").val(id);
  $("#Addwallet").modal('show');
  // alert('sds');
});
  $('.numbers').keyup(function () { 
    this.value = this.value.replace(/[^0-9\.]/g,'');
  });



  $(document).on('click','.addBtn',function(){
  // alert('sds');
  var balance = $('#balance').val();
  var id = $("#amout").val();
        // alert(balance);
        // alert(id);
        $.ajax({
          url: "{{route('user.amountstore')}}",
          type:"POST",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data:{
            'id':id,
            "balance":balance
          },
          cache: false,
          success: function(html){
              // alert(html);
              $("#Addwallet").modal('hide');
              console.log(html);
             location.reload()
                }
              });
      });


  $('.status').on('change',function()
  {
   var data = $(this).val();
   $("#status_value").val(data);
 });

  $('.date').on('change',function()
  {
   var date = $(this).val();
   $("#date2").val(date);


      
 });


  $('.filter').on('click', function() {

    var data = $("#status_value").val();
    var date = $("#date2").val();
    

    $.ajax({
      type: "GET",
      url: "{{ route('user.status_data') }}",
      data: {
        "data":data,
        "date":date,
      },        
      success: function (data)
      {          
        $('.user_table').html(data.data);
        $('#example').DataTable();

      }

    });
  });

 $(function() {
    $('#toggle-event').change(function() {
      // alert('sds');
      $('#console-event').html('Toggle: ' + $(this).prop('checked'))
    })
  })


 $(function() {
    $(document).on('change', '.toggle-class', function() {

        // alert('dds');
        var user_status = $(this).prop('checked') == true ? 1 : 0; 
        // alert(user_status);
        var id = $(this).data('id');
        // alert(id); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('user.change_status') }}',
            data: {'user_status': user_status, 'id': id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  })

</script>
@endsection
