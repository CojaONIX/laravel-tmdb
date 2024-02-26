@extends('layout')

@section('title', 'Items')

@section('content')

    <div class="row">
        <h4 class="col-3">Page: {{ $items->page }} / {{ $items->total_pages }}</h4>
        <form method="GET" action="{{ route('movie.popular') }}" class="col-4 d-flex justify-between">
            <input class="form-control col-2 me-2" type="search" name="page" placeholder="Page" aria-label="Search">
            <button class="btn btn-outline-success col-2" type="submit">Go to Page</button>
        </form>
    </div>

    <hr>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse($items->results as $item)
            <div class="card-group">
                <div class="card">

                    <img src="https://image.tmdb.org/t/p/original/{{ $item->backdrop_path }}" class="card-img-top" alt="...">


                    <div class="card-header">
                        @foreach($item->genre_ids as $genre)
                            <span class="badge rounded-pill text-bg-warning">{{ $genres[$genre] }}</span>
                        @endforeach
                    </div>

                    <div class="card-body">
                        <p class="card-text">{{ $item->id }}: {{ $item->original_title }}</p>
                        <h3 class="card-title">{{ $item->title }}</h3>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($item->overview, 3000, $end='...') }}</p>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <h4>Rate: {{ number_format($item->vote_average, 2) }}</h4>
                        <a href="{{ route('movie.details', ['movie' => $item->id]) }}" class="btn btn-primary">Read more...</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning" role="alert">No page found</div>
        @endforelse
    </div>


@endsection
