@extends('layouts.master') 
@section('title','KYC Verification')

@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="card-title">Perosonal Details</h4>
  </div>
  <div class="card-body">
    @if($users->image == null)
     <img src="{{asset('images/user.png')}}" height="35" width="35" style="border-radius:50px;">
     @else
  	<label><strong>Image:</strong></label><img class="rounded-circle" height="50px" width="50px" src="{{URL::asset('/upload/'.$users->image)}}" >
    @endif
  	<br>
  	<label><strong>Name:</strong></label>{{$users->name}}
    <br>
    <label><strong>User Name:</strong></label>{{$users->user_name}}
    <br>
  	<label><strong>Address</strong></label>{{$users->address}}
  	<br>
  	<label><strong>Mobile No:</strong></label>{{$users->mobile_no}}
  	<br>
  </div>
</div>
<div class="card">
  <div class="card-body">
    <h4 class="card-title">Kyc Documents Details</h4>

  	     <label><strong>Documents:</strong></label>
  		   @foreach ($kycs as $ImgName)
            @foreach (explode(',',$ImgName->document) as $ImgName)

  		   	@php
    		   $info = new SplFileInfo($ImgName);
  			   $extension = $info->getExtension();
    		   @endphp
  		   	@if($extension == 'pdf')
	  			<a target="_blank" href= "{{URL::asset('upload/kyc/'.$ImgName)}}"><i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size: 50px"></i></a>
  		   	@else
  		        <img height="100px" width="100px" src="{{URL::asset('upload/kyc/'.$ImgName)}}" >
          @endif
          <!-- <br> -->

      @endforeach
  		@endforeach
  </div>
</div>
@endsection