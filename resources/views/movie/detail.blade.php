@extends('layouts/main')

@section('title', 'movie detail')

@section('page-title', 'movie Detail')

@section('content')
    <div class="row">
        {{-- <div class="col-xl-12 col-lg-12">
            <div style="margin: 0 -24px -89px -24px;">
                <img src="https://askbootstrap.com/preview/vidoe-v2-3/theme-eight/img/cover3.jpg" class="img-fluid" alt="...">
            </div>
        </div> --}}
        <div class="col-xl-3 col-lg-3">
            <div class="bg-white p-3 widget shadow rounded mb-4">
                @if ($movie->poster || $movie->poster_link) 
                <img src="{{ $movie->poster ? asset('storage/'.$movie->poster) : $movie->poster_link }}" class="img-fluid rounded" alt="movie poster">
                @else
                <div class="bg-light d-flex align-items-center justify-content-center rounded" style="width: 100%; height: 380px;"><small>no poster uploaded</small></div>
                @endif
                <h1 class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Directors</h1>
                {{ str_replace(',', ' / ', $movie->directors) }}
                <h1 class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Writers</h1>
                {{ str_replace(',', ' / ', $movie->writers) }}
                <h1 class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Cast</h1>
                {{ str_replace(',', ' / ', $movie->cast) }}
                <h1 class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Plot</h1>
                <p class="mb-0">{{ $movie->plot }}</p>
                <h1 class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Plot</h1>
                <a href="{{ $movie->movie_link }}" class="badge badge-primary">Visit Link</a>
            </div>
        </div>
        <div class="col-xl-9 col-lg-9">

            <div class="bg-white info-header shadow rounded mb-4">
                <div class="row d-flex align-items-start justify-content-between p-3 border-bottom">
                    <div class="col-lg-7 m-b-4">
                        <h3 class="text-gray-900 mb-0 mt-0 font-weight-bold">{{ $movie->title }} <small>{{ $movie->year }}</small>
                        </h3>
                        <p class="mb-0 text-gray-800">
                            <small class="text-muted">
                                <i class="fas fa-film fa-fw fa-sm mr-1"></i>
                                @foreach ($categories as $category)
                                    @if (in_array($category->id, explode(',', $movie->category)))
                                        {{ $category->title }} /
                                    @endif
                                @endforeach
                            </small>
                        </p>
                    </div>
                    <div class="col-lg-5 text-right">
                        @foreach ($genres as $genre)
                          @if (in_array($genre->id, explode(',', $movie->genres)))
                            <span class="badge badge-dark">{{ $genre->title }}</span>
                          @endif
                        @endforeach
                    </div>
                </div>
                <div class="row d-flex align-items-center justify-content-between py-3 px-4">
                    <div class="col-lg-12 m-b-4 row">
                       <p class="mb-0 text-gray-900 mr-3">Release date: {{ $movie->release_date }}</p>
                       <p class="mb-0 text-gray-900 mr-3">Duration: {{ $movie->duration }}</p>
                       <p class="mb-0 text-gray-900 mr-3">Region: {{ $movie->region }}</p>
                       <p class="mb-0 text-gray-900 mr-3">
                           Language:
                           @foreach ($languages as $language)
                                @if ($language->id == $movie->language)
                                    {{ $language->title }}
                                @endif
                            @endforeach
                        </p>
                    </div>
                 </div>
            </div>
            <div class="bg-white p-3 widget shadow rounded mb-4">
                @if ($movie->cover || $movie->cover_link)
                    <img src="{{ $movie->cover ? asset('storage/'.$movie->cover) : $movie->cover_link }}" class="img-fluid rounded" alt="movie cover">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 350px; width: 100%;"><small>no cover uploaded</small></div>
                @endif
            </div>
            <div class="bg-white p-3 widget shadow rounded mb-4">
                <h4 class="font-weight-bold">Summary</h4>

                <p>{{ $movie->summary }}</p>
            </div>
        </div>
    </div>
@endsection
