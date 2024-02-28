@extends('layout')

@section('title', 'TV Items')

@section('content')

        <h4 class="">Page: {{ $items->page }} / {{ $items->total_pages }}</h4>
        <form method="GET" action="{{ route('tv') }}" class="">
            <div class="mb-2">
                <input type="radio" class="btn-check" name="tv-group" value="popular" id="popular" autocomplete="off" {{ request()->get('tv-group') == 'popular' ? ' checked' : ''  }} checked>
                <label class="btn btn-outline-primary col-2" for="popular">Popular</label>
                <input type="radio" class="btn-check" name="tv-group" value="top_rated" id="top_rated" autocomplete="off" {{ request()->get('tv-group') == 'top_rated' ? ' checked' : ''  }}>
                <label class="btn btn-outline-primary col-2" for="top_rated">Top Rated</label>
                <input type="radio" class="btn-check" name="tv-group" value="on_the_air" id="on_the_air" autocomplete="off" {{ request()->get('tv-group') == 'on_the_air' ? ' checked' : ''  }}>
                <label class="btn btn-outline-primary col-2" for="on_the_air">On The Air</label>
                <input type="radio" class="btn-check" name="tv-group" value="airing_today" id="airing_today" autocomplete="off" {{ request()->get('tv-group') == 'airing_today' ? ' checked' : ''  }}>
                <label class="btn btn-outline-primary col-2" for="airing_today">Airing Today</label>
            </div>

            <div class="row">
                <div class="col-1 me-2">
                    <input class="form-control" type="number" name="page" placeholder="Page" aria-label="Page" value="{{ $items->page }}" min="1" max="500">
                </div>
                <button class="btn btn-outline-success col-2" type="submit">Show</button>
            </div>
        </form>

    <hr>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse($items->results as $item)
            <div class="card-group">
                <div class="card">

                    <img src="https://image.tmdb.org/t/p/w780/{{ $item->backdrop_path }}" class="card-img-top" alt="...">

                    <div class="card-header">
                        @foreach($item->genre_ids as $genre)
                            <span class="badge rounded-pill text-bg-warning">{{ $genres[$genre] }}</span>
                        @endforeach
                    </div>

                    <div class="card-body">
                        <p class="card-text">{{ $item->id }}: {{ $item->original_name }}</p>
                        <h3 class="card-title">{{ $item->name }}</h3>
                        <p class="card-text">{{ $item->overview }}</p>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <h4>Rate: {{ number_format($item->vote_average, 2) }}</h4>
                        <a href="{{ route('tv.details', ['tv' => $item->id]) }}" class="btn btn-primary">Read more...</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning" role="alert">No page found</div>
        @endforelse
    </div>


@endsection
