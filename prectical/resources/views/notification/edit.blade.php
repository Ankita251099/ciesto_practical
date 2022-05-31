@extends('layouts.master')
@section('title','Edit Notifications')
@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="card-title">Edit Notification</h4>
  </div>
  <div class="card-body">
    <form method="post" action="{{route('notification.update',$notifications->id)}}" enctype="multipart/form-data">
      @csrf
       <div class="form-row">
        <div class="form-group col-md-12">
          <label>User Name</label>
          <select name="user_id" id="user_id" class="js-states form-control select2">
                  <option value="{{$notifications->user_id }}" selected="">~~SELECTED~~</option>
                  @foreach ($users as $user)
                    <option value="{{$user->id}}"  @if($user->id == $notifications->user_id) selected @endif>{{$user->user_name}}</option> 
                  @endforeach
                </select>
        </div>     
      </div>
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>Type</label>
           <p class="lead emoji-picker-container">
          <input type="text" class="form-control" name="type" id="txt_question"data-emojiable="true"
                value="{{$notifications->type}}"placeholder="Type">
        </p>
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
          <input type="file" class="form-control" name="image" value="{{$notifications->image}}">
          <img class="image_hide " width="100px" id="my_image" src="{{asset('upload/notification/'.$notifications->image)}}">
          @error('image')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
        <div class="form-row">
        <div class="form-group col-md-12">
          <label>Message</label>
          <p class="lead emoji-picker-container">
          <textarea class="ckeditor form-control" name="message" value=""data-emojiable="true"
              type="text">{{isset($notifications->id)? $notifications->message :''}}</textarea>
            </p>
          @error('message')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>Schedule</label>
          <input type="datetime-local" class="form-control" name="schedule" value="{{old('schedule')?? date('Y-m-d\TH:i', strtotime($notifications->schedule)) }}" >
          @error('schedule')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="{{route('notification.index')}}" class="btn btn-danger">Cancle</a>
    </form>
  </div>
</div>
@endsection
@section('script')
<script src="{{asset('vendor/select2/js/select2.full.min.js')}}"></script>

<script type="text/javascript">
$(document).ready(function() {
  // alert('ssd');
    $('.select2').select2()
    // alert('sds');
      $('#example').DataTable();
  });

  $(function() {
        // Initializes and creates emoji set from sprite sheet
        window.emojiPicker = new EmojiPicker({
          emojiable_selector: '[data-emojiable=true]',
          assetsPath: "{{asset('/lib/img/' )}}",
            popupButtonClasses: 'fa fa-smile-o'
        });
        // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
        // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
        // It can be called as many times as necessary; previously converted input fields will not be converted again
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
