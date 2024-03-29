@extends('layout')

@section('title', 'Movie Items')

@section('content')

        <form method="GET" action="{{ route('media.items', ['media'=>'movie']) }}">
            <div class="d-flex justify-content-evenly mb-2">
                <div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="media-group" value="popular" id="popular"{{ request()->get('media-group') == 'popular' ? ' checked' : ''  }} checked>
                        <label class="form-check-label" for="popular">Popular</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="media-group" value="top_rated" id="top_rated"{{ request()->get('media-group') == 'top_rated' ? ' checked' : ''  }}>
                        <label class="form-check-label" for="top_rated">Top Rated</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="media-group" value="upcoming" id="upcoming"{{ request()->get('media-group') == 'upcoming' ? ' checked' : ''  }}>
                        <label class="form-check-label" for="upcoming">Upcoming</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="media-group" value="now_playing" id="now_playing"{{ request()->get('media-group') == 'now_playing' ? ' checked' : ''  }}>
                        <label class="form-check-label" for="now_playing">Now Playing</label>
                    </div>
                </div>

                <div class="col-4 me-2">
                    <h5>Page: {{ $items->page }} / {{ $items->total_pages }}</h5>
                    <input class="form-control" type="number" name="page" placeholder="Page" aria-label="Page" value="{{ $items->page }}" min="1" max="500">
                    <button class="btn btn-outline-success col-12 my-2" type="submit">Show</button>
                </div>
            </div>
        </form>

    <hr>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse($items->results as $item)
            <div class="card-group">
                <div class="card">

                    @if($item->backdrop_path)
                    <img src="https://image.tmdb.org/t/p/w780/{{ $item->backdrop_path }}" class="card-img-top" alt="...">
                    @else
                    <img src="https://fakeimg.pl/390x220/cccccc/255/?text=No Image" class="card-img-top">
                    @endif

                    <div class="card-header">
                        @foreach($item->genre_ids as $genre)
                            <span class="badge rounded-pill text-bg-warning">{{ $items->genres[$genre] }}</span>
                        @endforeach
                    </div>

                    <div class="card-body">
                        <p class="card-text">{{ $item->id }}: {{ $item->original_title }}</p>
                        <h3 class="card-title">{{ $item->title }}</h3>
                        <p class="card-text">{{ $item->overview }}</p>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <h4>Rate: {{ number_format($item->vote_average, 2) }}</h4>
                        <a href="{{ route('media.details', ['media' => 'movie', 'id' => $item->id]) }}" class="btn btn-primary">Read more...</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning" role="alert">No page found</div>
        @endforelse
    </div>


@endsection
