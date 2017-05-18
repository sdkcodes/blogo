<!-- Categories Widget -->
                <div class="card my-4">
                    <h5 class="card-header"><a href="{{url('/categories') }}">Categories</a></h5>
                    <div class="card-block">
                        <div class="row">
                        @foreach ($categories->chunk(1) as $chunk)
                            <div class="col-sm-6 col-lg-6">
                                <ul class="list-unstyled mb-0">
                                @foreach ($chunk as $category)
                                    
                                        <li><a href="{{ url('categories/'.$category->title) }}">{{ $category->title }}</a></li>
                                    
                                @endforeach
                                </ul>
                            </div>
                        @endforeach
                            <!-- <div class="col-lg-6">
                                <ul class="list-unstyled mb-0">
                                    <li><a href="#">Web Design</a></li>
                                    <li><a href="#">HTML</a></li>
                                    <li><a href="#">Freebies</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <ul class="list-unstyled mb-0">
                                    <li><a href="#">JavaScript</a></li>
                                    <li><a href="#">CSS</a></li>
                                    <li><a href="#">Tutorials</a></li>
                                </ul>
                            </div> -->
                        </div>
                    </div>
                </div>