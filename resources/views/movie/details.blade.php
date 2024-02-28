@extends('layout')

@section('title', 'Movie Details')

@section('content')

    <div class="card-footer d-flex justify-content-start">
        <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    </div>

    <hr>

        <div class="card-group">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-3">
                        @if($item->poster_path)
                            <img src="https://image.tmdb.org/t/p/original/{{ $item->poster_path }}" class="img-fluid rounded-start" alt="...">
                        @else
                            <img src="https://fakeimg.pl/300x450/cccccc/255/?text=No Image" class="card-img-top">
                        @endif
                    </div>

                    <div class="col-md-9">
                        <div class="card-header">
                            @foreach($item->genres as $genre)
                                <span class="badge rounded-pill text-bg-warning">{{ $genre->name }}</span>
                            @endforeach
                        </div>

                        <div class="card-body">
                            <p class="card-text">{{ $item->original_title }}</p>
                            <h3 class="card-title">{{ $item->title }}</h3>
                            <p class="card-text">{{ $item->overview }}</p>
                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            <h4>Rate: {{ number_format($item->vote_average, 2) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <hr>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            @foreach($item->casts->cast as $cast)
                <div class="card-group">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="text-center text-primary">{{ $cast->character }}</h5>
                        </div>

                        @if($cast->profile_path)
                            <img src="https://image.tmdb.org/t/p/w300/{{ $cast->profile_path }}" class="card-img-top" alt="...">
                        @else
                            <img src="https://fakeimg.pl/300x450/cccccc/255/?text=No Image" class="card-img-top">
                        @endif

                        <div class="card-body">
                            <h5 class="text-center">{{ $cast->credit_id }}</h5>
                        </div>

                        <div class="card-footer">
                            <h5 class="text-center">{{ $cast->name }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


@endsection
