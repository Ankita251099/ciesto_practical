@extends('layouts.master')
@section('title','Add Notifications')

@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="card-title">Add Notification</h4>
  </div>
  <div class="card-body">
    <form method="post" action="{{route('notification.add')}}" enctype="multipart/form-data">
      @csrf
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>User Name</label>
          <select name="user_id" id="user_id" class="js-states form-control select2">
                    <option value="" selected="">~~SELECTED~~</option>
                   @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ucfirst($user->user_name)}}</option>
                @endforeach
                </select>    
        <!-- </div> -->
        
        
         <!-- <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Tagsinput</h4>
                                    </div>
                                    <div class="card-body">
                                        <input name="user_id" class="form-control tags" id="tags_1" placeholder="Add tags" type="text" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
      <!-- </div> -->
      <div class="form-row">  
        <div class="form-group col-md-12">

          <label>Type</label>
           <p class="lead emoji-picker-container">
          <input type="text" class="form-control" name="type" id="txt_question"data-emojiable="true"  placeholder="Type">
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
          <input type="file" class="form-control" name="image" id="image_file">
             <img class="image_hide " width="100px" id="my_image" src="#">
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
              <textarea class="form-control textarea-control" rows="3" placeholder="Message" data-emojiable="true" name="message"></textarea>
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
          <label>Schedule ON</label>
          <input type="datetime-local" class="form-control"name="schedule" placeholder="Type">
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
<!-- <script src="{{asset('js/plugins-init/select2-init.js')}}"></script> -->
<script src="{{asset('vendor/select2/js/select2.full.min.js')}}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> -->
<script type="text/javascript">
$(document).ready(function() {
  // alert('ssd');
    $('.select2').select2()
    // alert('sds');
      $('#example').DataTable();
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


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#my_image').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#image_file").change(function(){
    readURL(this);
});
</script>
@endsection