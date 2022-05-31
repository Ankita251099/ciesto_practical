@extends('layouts.master')
@section('content')
<div class="card">
	<div class="card-header">
		<h4 class="card-title">Add Video</h4>
	</div>
	<div class="card-body">   

		<div class="form-horizontal">
			<form method="post" action="{{route('video.update',$videos->id)}}">
				@csrf
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Video Linksdsd</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="link" value="{{$videos->link}}" placeholder="Link">
					</div>
				</div>
				
				<div class="form-group row pt-4">
					<div class="col-md-12 ">
						<button type="submit"  class="btn btn-primary btn-lg">Save</button>

					</div>

				</div>
			</form>
		</div>
	</div>
</div>
@endsection


