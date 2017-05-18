@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				@if (count ($errors) > 0)
					<div class="alert alert-danger">
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</div>
				@endif
				
				<form class="" role="form" action="/updatepost" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group">
						<input type="text" name="title" class="form-control" placeholder="Post Title" value="{{$post->title}}">
					</div>
					<input type="hidden" name="post_id" value="{{$post->id}}">
					<div class="form-group">
						<textarea class="form-control" placeholder="Body" name="body" rows="20">{!! $post->body !!}</textarea>
					</div>
					
					<div class="form-group">
						<button class="btn btn-success" type="submit" name="action" value="publish">Update Post</button>
						<button class="btn btn-danger" type="submit" value="draft" name="action">Revert to draft</button>
					</div>
				</form>		
			</div>
		</div>	
	</div>
@endsection