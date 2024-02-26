@extends('layout')

@section('title', 'Details')

@section('content')

    <div class="card-footer d-flex justify-content-start">
        <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    </div>

    <hr>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-1 g-4">
        <div class="card-group">
            <div class="card">

                <img src="https://image.tmdb.org/t/p/original/{{ $item->backdrop_path }}" class="card-img-top" alt="...">

                <div class="card-header">
                    @foreach($item->genres as $genre)
                        <span class="badge rounded-pill text-bg-warning">{{ $genre->name }}</span>
                    @endforeach
                </div>

                <div class="card-body">
                    <p class="card-text">{{ $item->original_title }}</p>
                    <h3 class="card-title">{{ $item->title }}</h3>
                    <p class="card-text">{{ \Illuminate\Support\Str::limit($item->overview, 3000, $end='...') }}</p>
                </div>

                <div class="card-footer d-flex justify-content-between">
                    <h4>Rate: {{ number_format($item->vote_average, 2) }}</h4>
                </div>
            </div>
        </div>
    </div>


@endsection
