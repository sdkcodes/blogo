@extends ('layouts.header')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h3 class="my-4">Categories > {{ $category->title }}</h1>
				@include("partials.posts-list")
			</div>
			@include("partials.search")

			@include("partials.categories")

			@include("partials.side")
		</div>
	</div>
@endsection