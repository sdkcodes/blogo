    @extends('layouts.header')
    @section('content')
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="my-4">{{ config('app.name')}} <small>A nice blogging system</small></h1>

                
                    <!-- Blog Post -->
                    <div class="card mb-4">

                        <!-- <img class="card-img-top img-fluid" src="http://placehold.it/750x300" alt="Card image cap"> -->
                        <div class="card-block">
                            <h2 class="card-title">{{ $post->title }}</h2>
                            <p class="card-text">{!! $post->body !!}</p>
                            
                        </div>
                        <div class="card-footer text-muted">
                            Posted on {{ $post->created_at }} by <a href="#">{{ $post->user->name }}</a>
                            
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="h3">{{ count($comments) }} comments:</div>
                            <form action="/publishcomment" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Your name">
                                </div>
                                <input type="hidden" name="post_id" value="{{$post->id}}">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Enter your comment here..." rows=4 name="body"></textarea>
                                </div>
                                <div class="form-group"><button class="btn btn-danger" type="submit">Comment</button></div>
                            </form>
                        </div>
                    </div>
                    <div class="comments" name="#comments">
                        @foreach($comments as $comment)
                            {{$comment->name}}
                            <br>
                            {{ $comment->created_at}}
                            <br>
                            {{ $comment->body}}
                            <hr>
                        @endforeach
                    </div>

                <!-- Pagination -->
                <!-- <ul class="pagination justify-content-center mb-4">
                    <li class="page-item"><a class="page-link" href="#">&larr; Older</a></li>
                    <li class="page-item disabled"><a class="page-link" href="#">Newer &rarr;</a></li>
                </ul> -->

            </div>

            @include("partials.search")

            @include("partials.categories")

            @include("partials.side")
                

            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
    @endsection