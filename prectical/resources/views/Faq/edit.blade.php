@extends('layouts.master')
@section('title',' Edit FAQ')

@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="card-title">Edit Faq</h4>
  </div>
  <div class="card-body">
    <form method="post" action="{{route('Faq.update',$Faqss->id)}}">
      @csrf
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>Question</label>
          <input type="text" class="form-control" name="question" value="{{$Faqss->question}}" placeholder="Question">
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
          <input type="text" class="form-control" name="answer"  value="{{$Faqss->answer}}" placeholder="Answer">
          @error('answer')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>

  </div>
</div>
@endsection
