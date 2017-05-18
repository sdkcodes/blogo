@forelse ($posts as $post)
    <!-- Blog Post -->
    <div class="card mb-4">

        <!-- <img class="card-img-top img-fluid" src="http://placehold.it/750x300" alt="Card image cap"> -->
        <div class="card-block">
            <h2 class="card-title"><a href="{{ url('posts/'.$post->slug)}}">{{ $post->title }}</a></h2>
            <p class="card-text">{{ substr($post->body, 0, 225) }}</p>
            <a href="/posts/{{$post->slug}}" class="btn btn-primary"> Read More &rarr;</a>
        </div>
        <div class="card-footer text-muted">
            Posted on {{ $post->created_at }} by <a href="#">{{ $post->user->name }}</a>
        </div>
    </div>    
@empty
    No posts
@endforelse