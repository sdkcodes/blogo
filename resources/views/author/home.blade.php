
@extends('layouts.app')

@section('content')
<div class="container">
        @include('author.sidenav')
        <div class="col-md-9 ">
            <div class="panel panel-default">
                @include("partials.errors")
                <div class="panel-heading">Dashboard - All Posts <a class="btn btn-danger" href="/newpost">New Post</a></div>

                <div class="panel-body">
                    @if (count($posts) > 0)
                        <!-- <div class="list-group"> -->
                            @foreach ($posts as $post)

                                <!-- <li class="list-group-item"> -->
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-md-6">

                                                    {{ substr($post->title, 0, 70) }} 
                                                    <br>
                                                    <a href="/editpost/{{$post->slug}}" style="color:brown">Edit</a>     
                                                    <a href="/posts/{{$post->slug}}" target="_blank" class="" style="color:brown">View</a> 
                                                    @if ($post->active === 0) 
                                                        <a href="/editpost/{{$post->slug}}/edit/publish" style="color: brown;">Publish</a>
                                                    @else
                                                        <a href="/editpost/{{$post->slug}}/edit/draft" style="color: brown;">Draft</a>
                                                    @endif
                                                </div>
                                                <div class="col-md-3">
                                                   by {{ $post->user->name }}        
                                                </div>
                                                <div class="col-md-3">
                                                    <span class="hidden-xs hidden-sm">{{$post->created_at }}</span>       
                                                </div>

                                            </div>
                                             
                                        </div>
                                        <!-- <div class="panel-body">
                                            {{ substr($post->body, 0, 20) }}    
                                        </div> -->
                                    </div>
                                        
                                    
                                <!-- </li> -->
                            @endforeach    
                        <!-- </div> -->
                        
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
