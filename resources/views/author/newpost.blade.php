@extends ('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<form class="" role="form" action="/newpost" method="post" enctype="multipart/form-data">
			<div class="col-md-8 col-md-offset-1">
				@include("partials.errors")
				
					{{ csrf_field() }}
					<div class="form-group">
						<input type="text" name="title" class="form-control" placeholder="Post Title">
					</div>
					<div class="form-group">
						<textarea class="form-control" placeholder="Body" name="body" rows="18"></textarea>
					</div>
					
					
						
			</div>
			@include('author.publish_settings_sidebar')
			</form>
		</div>	
	</div>
	
	
@endsection