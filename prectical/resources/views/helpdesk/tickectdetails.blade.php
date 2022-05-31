@extends('layouts.master')
@section('title','Helpdesk')

@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="card-title">Send Message</h4>
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
    <form method="post" action="{{route('helpDesk.ticketdetailsstore')}}" enctype="multipart/form-data">
      @csrf

      <div class="row">
        <div class="form-group col-md-6">
        @foreach($values as $value)
        <div class="card">
          <div class="card-body">
            @if($value->user_id == "1")
            @if($value->user_image['image'] == null)
            <img src="{{asset('images/admin.jpg')}}" height="35" width="35" style="border-radius:50px;">
            @else
           <img src="{{asset('upload/'.$value->user_image['image'])}}" alt="" height="35" width="35" style="border-radius: 50px;">
           @endif
           <br>
           <label><strong>Name:</strong></label>{{$value->user_image['name']}}
         
           <label style="float: right;"><strong>Message:</strong> {{ $value->message }}<br>
          @php
              $info = new SplFileInfo($value->attechment);
              $extension = $info->getExtension();
          @endphp
          @if($extension == 'pdf')
              <a target="_blank" href= "{{URL::asset('upload/'.$value->attechment)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
          @else 
          @if(empty($value->attechment))
          @else
              <a target="_blank" href="{{URL::asset('upload/'.$value->attechment)}}">

              <img class="" height="50px" width="50px" src="{{URL::asset('upload/'.$value->attechment)}}" ></a>
            @endif
          @endif
        </label>
            @else
             @if($value->user_image['image'] == null)
            <img src="{{asset('images/user.png')}}" height="35" width="35" style="border-radius:50px;">
            @else
           <img src="{{asset('upload/'.$value->user_image['image'])}}"  alt="" height="35" width="35" style="border-radius: 50px;">
           @endif
           <br>
           
           <label><strong>Name:</strong></label>{{$value->user_image['name']}}

            @if(!empty($value->message))
             <label style="float: right;"><strong>Message:</strong>
            {{$value->message}}<br> 
            @else

           @endif
              @php
              $info = new SplFileInfo($value->attechment);
              $extension = $info->getExtension();
          @endphp
          @if($extension == 'pdf')
              <a target="_blank" style="float: right;" href="{{URL::asset('upload/'.$value->attechment)}}"><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></a>
          @else
          @if(empty($value->attechment))
          @else
              <a target="_blank" style="float: right;" href="{{URL::asset('upload/'.$value->attechment)}}">

              <img class="" style="float: right;" height="50px" width="50px" src="{{URL::asset('upload/'.$value->attechment)}}" ></a>
          @endif
          @endif
           </label>

           @endif
          </div>
        </div>
        @endforeach
        </div>
      </div>
      <div class="form-row">

        <div class="form-group col-md-12">
                        <label>Message</label>
                       <p class="lead emoji-picker-container">
                        <textarea class="form-control textarea-control" rows="2" placeholder="Message" data-emojiable="true" name="message"></textarea>
                      </p>
                        <span class="text-danger messageError"></span>
                        @error('message')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
      </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        

        <a href="{{route('helpdesk.index')}}" type="button" class="btn btn-danger">Cancle</a>
        <input type="hidden" name="ticket_id" value="{{$testData->id}}">
       


    </form>
  </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
   $(document).ready(function(){
    $('.alert-success').fadeIn().delay(3000).fadeOut();
      });
   
  $(function() {

        window.emojiPicker = new EmojiPicker({
          emojiable_selector: '[data-emojiable=true]',
          assetsPath: "{{asset('/lib/img/' )}}",
          popupButtonClasses: 'fa fa-smile-o'
        });

        window.emojiPicker.discover();
      });
  
      // Google Analytics
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-49610253-3', 'auto');
      ga('send', 'pageview');
</script>
@endsection
