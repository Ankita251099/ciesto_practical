@extends('layouts.master')
@section('title','Video')
@section('content')
<div class="card">
	<div class="card-header">
		<h4 class="card-title">Add Video</h4>
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

  <div class="form-horizontal">
   <form method="POST" action="{{route('video.add')}}">
    @csrf
    <div class="form-group row">
     <label class="col-sm-2 col-form-label">Language</label>
     <div class="form-group">
      
       
       <select name="language" id="language" class="form-control language">
         <div class="alert-message" id="languageError"></div>
         <option disabled="" selected="~~Select~~">~~Seleted~~</option>
         <option value="hindi">Hindi</option>
         <option value="english">English</option>

         
       </select>
     </div>
   </div>
   <div class="form-group row">
     <label class="col-sm-2 col-form-label">Video link</label>
     <div class="col-sm-10">
      <input type="text" class="form-control" name="link" id="link" placeholder="Link">
      
      @error('link')
      <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
  </div>
  
  <div class="form-group row pt-4">
   <div class="col-md-12">
    <button type="submit"  class="btn btn-primary btn-lg">Save</button>

  </div>

</div>
</form>
</div>
</div>
</div>
@endsection

@section('script')

<script type="text/javascript">
	$( document ).ready(function() {
   $("select.language").change(function(){
     var Selectedlanguage = $(this).children("option:selected").val();
          // alert(Selectedlanguage);
         if(Selectedlanguage){
         	// alert('asd');
          $.ajax({
            type:"GET",
            dataType: "json",
            url:"{{url('addvideo')}}?language="+Selectedlanguage,
            success:function(res){               
              if(res){
                    // alert('asd');

                    console.log(res);
                    $('#link').val(res);
                  }
                  else{

                        // alert('ad');
                      }
                    }
                  });
        }else{
          $("#link"+row).empty();
        }
        
      });
   
 });
</script>
@endsection