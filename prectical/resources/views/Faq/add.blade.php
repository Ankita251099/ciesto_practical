@extends('layouts.master')
@section('title',' Add FAQs')

@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="card-title">Add Faq</h4>
  </div>
  <div class="card-body">
    <form method="post" action="{{route('Faq.add')}}">
      @csrf
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>Question</label>
          <input type="text" class="form-control" name="question" id="txt_question" placeholder="Question">
          @error('question')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>Answer</label>
          <input type="text" class="form-control" name="answer" id="answer" placeholder="Answer">
          @error('answer')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="{{route('Faq.index')}}" type="button" class="btn btn-danger">Cancel</a>

    </form>
  </div>
</div>
@endsection
