@extends('layouts.master') 

@section('content')

<div class="card">
  <div class="card-header">
      <h4 class="card-title">Videos</h4>
    </div>
	<div class="card-body">
		
		<div class="row pb-2">
			
		<div class="col-12">                   
                      <a href="{{route('video.add')}}" type="button" style="float: right;" class="btn btn-primary ">How to add Videos</a>
                </div>
		</div>
		<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Video Link</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  	
    <tr>
      <th scope="row"></th>
      <td></td>
      <td></td>
      
    </tr>
    
  </tbody>
  
</table>
	</div>
	
</div>

@endsection