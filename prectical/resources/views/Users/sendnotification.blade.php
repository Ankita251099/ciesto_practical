@extends('layouts.master')
@section('title','Send Notification')

@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="card-title">Send Notification</h4>
  </div>
  <div class="card-body">
    <form method="post" action="{{route('user.storenotification')}}" enctype="multipart/form-data">
      @csrf
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>Type</label>
          <input type="text" class="form-control" name="type" id="txt_question" placeholder="Type">
          @error('type')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>Image</label>
          <input type="file" class="form-control" name="image">
          @error('image')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
        <div class="form-row">
        <div class="form-group col-md-12">
          <label>Message </label>
          <p class="lead emoji-picker-container">
              <textarea class="form-control textarea-control" rows="3" placeholder="Message" data-emojiable="true" name="message"></textarea>
          
          @error('message')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="{{route('user.view')}}" type="button" class="btn btn-danger">Cancle</a>

      <input type="hidden" name="user_id" value="{{$userData->id}}">
    </form>
  </div>
</div>


@endsection

@section('script')


<script type="text/javascript">

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