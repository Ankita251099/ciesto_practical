@extends('layouts.master')
@section('title',' Edit User')

@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="card-title">Edit User</h4>
  </div>
  <div class="card-body">
    <form method="post" action="{{route('user.update',$users->id)}}">
      @csrf
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>User Name</label>
          <input type="text" class="form-control" name="user_name" value="{{$users->user_name}}" placeholder="User Name">
          @error('user_name')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="form-row">

        <div class="form-group col-md-12">
          <label>Email</label>
          <input type="text" class="form-control" name="email"  value="{{$users->email}}" placeholder="Email">
          @error('email')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="{{route('user.view')}}" type="button" class="btn btn-danger">Cancle</a>

    </form>

  </div>
</div>
@endsection
