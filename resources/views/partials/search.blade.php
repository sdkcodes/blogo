 <!-- Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Search Widget -->
                <div class="card my-4">
                    <form method="get" action="{{url('/search')}}">
                    <h5 class="card-header">Search</h5>
                    <div class="card-block">
                        <div class="input-group">
                            <input type="text" class="form-control" name="q" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="submit">Go!</button>
                            </span>
                        </div>
                    </div>
                    </form>
                </div>

{{-- <script src="{{ asset('js/jquery.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.10.1/jquery.mark.es6.js"></script>
<script>
    $(document).ready(function(){
        var search_query = "{{ $search_query }}";
        $("body").mark(search_query,{
            "element":"span"
        });
    });
</script>  --}}               