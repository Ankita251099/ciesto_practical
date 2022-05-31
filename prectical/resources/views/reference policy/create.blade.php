@extends('layouts.master')
@section('title','Refernce Policy')
@section('head')



<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

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

                        <form method="post" action="{{route('policy.add')}}" enctype="multipart/form-data">

                            @csrf

                            
                            <input type="hidden" name="hidden_id" id="hidden_id" value="{{isset($referencepolicys->id)? $referencepolicys->id :'0'}}">
                            <div class="form-group">

                                <label><strong>Description</strong></label>

                                <textarea class="ckeditor form-control" name="description">{{isset($referencepolicys->id)? $referencepolicys->description :''}}</textarea>
                                @error('description')
                                  <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                            </div>

                            <div class="form-group " >

                                <button type="submit" class="btn btn-primary btn-lg">Save</button>

                            </div>

                        </form>

                    </div>

                </div>

           

    @endsection

    
    @section('script')
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

    <script type="text/javascript">
$(document).ready(function(){
    $('.alert-success').fadeIn().delay(3000).fadeOut();
      });
        $(document).ready(function() {

         $('.ckeditor').ckeditor();

     });

 </script>

 @endsection  

