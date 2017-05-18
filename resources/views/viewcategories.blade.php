@extends('layouts.header')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<ul class="list-group">
					@foreach ($categories as $category)
						<li class="list-group-item">
							<a href="{{ url('categories/'.$category->title) }}">{{ $category->title }}</a>
						</li>
					@endforeach
				</ul>
			</div>
			@include("partials.search")

			@include("partials.categories")

			@include("partials.side")
		</div>
	</div>
@endsection