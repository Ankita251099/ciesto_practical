@extends('layouts.master')
@section('title','Windrol')
@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="card-title">Windrol</h4>
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
    	<label>Status:</label>
    <div class="form-group col-md-2">
       <select name="status" required="" id="status_active" class="select2 form-control status">
         <option  selected="" value="">~~SELECT~~</option>
         <option value="padding">pending</option>
         <option value="rejected">failed</option>
         <option value="verified">paid</option>
       </select>
     </div>
     <div class="form-group col-md-2">
      <button type="button" class="btn btn-danger btn-lg filter">Filter</button>
    </div>
    </div>
    <table class="table table-bordered" id="example">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Date</th>
          <th scope="col">Name</th>
          <th scope="col">Mobile</th>
          <th scope="col">Details</th>
          <th scope="col">Amount</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
          
        </tr>
      </thead>
      <tbody>
        
      </tbody>
      
    </table>
  </div>
  
</div>

@endsection