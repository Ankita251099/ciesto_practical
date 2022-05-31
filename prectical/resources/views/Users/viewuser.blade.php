@extends('layouts.master') 
@section('title','User Details')

@section('content')

<div class="form-row">
  
  <div class="col-md-6">
<div class="card cardstyle">
    
  <div class="card-header">
    <h4 class="card-title">Personal Details</h4>
  </div>
  <div class="card-body">
  	<img class="rounded-circle" height="50px" width="50px" src="{{URL::asset('/upload/'.$users->image)}}" >
  	<br>
    <br>
  	<label><strong>Name:</strong></label>
  	<br>
    {{$users->name}}
    <br>
    <br>
  	<label><strong>Address</strong></label>
  	<br>
    {{$users->address}}
    <br>
    <br>
    <label><strong>Email:</strong></label>
    <br>
    {{$users->email}}
    <br>
    <br>
  	<label><strong>Mobile No:</strong></label>
  	<br>
    {{$users->mobile_no}}
    <br>
    <br>
  </div>
 
  </div>
</div>
        <!-- <div class="col-md-1"></div> -->

<div class="col-md-6">
<div class="card cardstyle">
    
  <div class="card-header">
    <h4 class="card-title">Amount Details</h4>
  </div>
  <div class="card-body">
    <img class="rounded-circle" height="50px" width="50px" src="{{URL::asset('/upload/'.$users->image)}}" >
    <br>
    <br>
      <!-- <label><strong>Bank name:</strong></label>
      <br>
      @if(!is_null($users->bankdetails))
      {{$users->bankdetails->bank_name}}
      @else
      @endif

      <br>
      <br> -->
    <label><strong>Upi:</strong></label>
    <br>
     @if(!is_null($users->upidetails))
    {{$users->upidetails->upi_id}}
    @else
    @endif
    <br>
    <br>
   <label><strong>Paytm:</strong></label>
    <br>
     @if(!is_null($users->paytmdetails))
    {{$users->paytmdetails->paytm_id}}
    @else
    @endif
    <br>
    <br>
    <label><strong>Total Added Balance:</strong></label>
    <br>
      ₹ {{$totalbalance}}
    <br>
    <br>
    <label><strong>Total withdraw:</strong></label>
    <br>
      ₹ {{$totalwithdraw}}
    <br>
    <br>
  </div>
 
  </div>
</div>
</div>
<div class="card">
<div class="card-body">
  <div class="row">
    <label>Date:</label>
   <div class="form-group col-md-2">
      <input type="date" id="date" name="date" class="form-control date">
    </div>
    <div class="form-group col-md-2">
      <button type="button" class="btn btn-danger btn-lg filter">Filter</button>
    </div>
  </div>
  <div class="transactionhistroy">
  @include('Users.transactionhistroy')
    
  </div>
</div>
<input type="hidden" name="id" id="id" value= "{{$users->id}}">
<input type="hidden" name="date2" id="date2" >
</div>
  

@endsection
@section('script')
<script type="text/javascript">
  $('.date').on('change',function()
  {
    var date = $(this).val();
   $("#date2").val(date);
      
 });
   $('.filter').on('click', function() {
    var id = $("#id").val();
    var date = $("#date2").val();
    

    $.ajax({
      type: "GET",
      url: "{{ route('viewuser.date') }}",
      data: {
        "id": id,
        "date":date,
      },        
      success: function (data)
      {          
        $('.transactionhistroy').html(data.data);
        $('#example').DataTable();

      }

    });
  });

</script>
@endsection