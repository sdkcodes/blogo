    @extends('layouts.header')
    @section('content')
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="my-4">{{ config('app.name')}} <small>A nice blogging system</small></h1>

                @include("partials.posts-list")
                

                

                <!-- Pagination -->
                <ul class="pagination justify-content-center mb-4">
                    <li class="page-item"><a class="page-link" href="#">&larr; Older</a></li>
                    <li class="page-item disabled"><a class="page-link" href="#">Newer &rarr;</a></li>
                </ul>

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