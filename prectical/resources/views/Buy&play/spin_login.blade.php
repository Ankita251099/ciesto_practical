@extends('layouts.master')
@section('title','Spin Login')

@section('content')
<div class="card">
<div class="card-body">                                
    <div class="basic-form">
        <form method="post" action="{{route('spin_login.add')}}">
            @csrf
            <div class="form-group row">
             <label class="col-sm-2 col-form-label">Enter Password:</label>
            	<div class="col-sm-8">
                 <input type="password" class="form-control" name="password" placeholder="Password">
                 @error('password')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
            
                                     
            
                    <button type="submit" class="btn btn-primary btn-lg" style="float: right;">Login</button>
                    
            </div>
        </form>
    </div>
</div>	
</div>

@endsection