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
                        <img src="https://image.tmdb.org/t/p/original/{{ $item->poster_path }}" class="img-fluid rounded-start" alt="...">
                    </div>

                    <div class="col-md-9">
                        <div class="card-header">
                            @foreach($item->genres as $genre)
                                <span class="badge rounded-pill text-bg-warning">{{ $genre->name }}</span>
                            @endforeach
                        </div>

                        <div class="card-body">
                            <p class="card-text">{{ $item->original_name }}</p>
                            <h3 class="card-title">{{ $item->name }}</h3>
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
            @foreach($item->seasons as $season)

                    <div class="card-group">
                        <div class="card">

                            <div class="card-header">
                                <h5 class="text-center text-primary">{{ $season->air_date }}</h5>
                            </div>

                            <img src="https://image.tmdb.org/t/p/w300/{{ $season->poster_path }}" class="card-img-top" alt="...">

                            <div class="card-footer">
                                <h5 class="text-center">{{ $season->name }}</h5>
                            </div>
                        </div>
                    </div>

            @endforeach
        </div>


@endsection
