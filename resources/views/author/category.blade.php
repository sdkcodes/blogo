@extends('layouts.app')

@section('content')
	<div class="container">
		@include('author.sidenav')
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">Manage Categories</div>
				<div class="panel-body">
					@include("partials.errors")
					<form action="/backend/addcategory" method="post">
					    {{ csrf_field() }}
						<div class="form-group">
							<input type="text" name="title" class="form-control" placeholder="Category title">
						</div>
						<div class="form-group">
							<button class="btn btn-info" type="submit">Add Category</button>
						</div>
					</form>
					<div class="categories-list">
					

						<ul>
							@foreach ($categories as $category)

                               <li>{{$category->title}}</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection