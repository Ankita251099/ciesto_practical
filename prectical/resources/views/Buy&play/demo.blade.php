@extends('layouts.master') 

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}"/>
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
                </div>
		</div>
    <form method="post" action="{{url('multipleusersdelete')}}">
      @csrf
      <input class="btn btn-success" type="submit" data-url="{{url('multipleusersdelete')}}" name="submit" value="Delete All Users"/>

		<table class="table table-bordered">
  <thead>
    <tr>
      <th class="text-center"><input type="checkbox" name="colorCheckbox" value="check"></th>
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
        <!-- <div class="checkbox">
          
        </div> -->
        <input name='id[]' type="checkbox" id="checkItem" 
                         value="{{$spin->id}}">
      </td>
      <td>{{$spin->amount}}</td>
      <td>{{$spin->price}} , {{ $spin->price1}} , {{$spin->price2}} , {{$spin->price3}} , {{$spin->price4}} , {{$spin->price5}} , {{$spin->price6}} , {{$spin->price7}} , {{$spin->price8}} , {{$spin->price9}}</td>
      <td>
        <a class="badge badge-success shadow-success" href="{{route('spin.edit',$spin->id)}}"> 
                                            
                                             <i class="fa fa-pencil-square-o" ></i> </a>
                                             <a class="badge badge-danger shadow-danger this_destroy"  data-url="{{route('spin.delete',$spin->id)}}" ><i class="fa fa-trash-o"></i> </a>
      </td>
    </tr>
    @endforeach
  </tbody>
  
</table>
<!-- </form>
 -->	</div>
	
</div>

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script type="text/javascript">

    $(document).ready(function() {
            $('input[type="checkbox"]').click(function() {
                var inputValue = $(this).attr("value");
                $("." + inputValue).toggle();
            });
        });

     $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
     
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
</script>
@endsection