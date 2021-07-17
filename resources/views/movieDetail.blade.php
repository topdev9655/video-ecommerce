@extends('layouts.app')

@section('title', 'movie detail')
    
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12" style="margin-bottom: -5rem">
       <div class="cover-pic">
          {{-- <div class="position-absolute bg-white shadow-sm rounded text-center p-2 m-4 love-box">
             <h6 class="text-gray-900 mb-0 font-weight-bold"><i class="fas fa-heart text-danger"></i> 50%</h6>
             <small class="text-muted">8,784</small>
          </div> --}}
          <img src="{{ $movie->cover ? asset('storage/'.$movie->cover) : $movie->cover_link }}" class="img-fluid" alt="movie-cover-{{ $movie->title }}" style="width: 100%;">
       </div>
    </div>
    <div class="col-xl-3 col-lg-3">
       <div class="bg-white p-3 widget shadow rounded mb-4">
          <img src="{{ $movie->poster ? asset('storage/'.$movie->poster) : $movie->poster_link }}" class="img-fluid rounded" alt="movie-poster-{{ $movie->title }}">
          <h1 class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Directors</h1>
          {{ str_replace(',', ' / ', $movie->directors) }}
          <h1 class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Writers</h1>
          {{ str_replace(',', ' / ', $movie->writers) }}
          <h1 class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Cast</h1>
          {{ str_replace(',', ' / ', $movie->cast) }}
          <h1 class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Plot</h1>
          <p class="mb-0">{{ $movie->plot }}</p>
       </div>
    </div>
    <div class="col-xl-9 col-lg-9">
       <div class="bg-white info-header shadow rounded mb-4">
          <div class="row d-flex align-items-start justify-content-between p-3 border-bottom">
             <div class="col-lg-7 m-b-4">
                <h3 class="text-gray-900 mb-0 mt-0 font-weight-bold">{{ $movie->title }} <small>{{ $movie->year }}</small></h3>
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
            <div class="col-lg-10 m-b-4 row">
               <p class="mb-0 text-gray-900 mr-3"><span class="font-weight-bold">Release date:</span> {{ date('d M Y', strtotime($movie->release_date)) }}</p>
               <p class="mb-0 text-gray-900 mr-3"><span class="font-weight-bold">Duration:</span> {{ $movie->duration }}</p>
               <p class="mb-0 text-gray-900 mr-3"><span class="font-weight-bold">Region:</span> {{ $movie->region }}</p>
               <p class="mb-0 text-gray-900 mr-3">
                  <span class="font-weight-bold">
                  Language:
                  </span>
                  @foreach ($languages as $language)
                     @if ($language->id == $movie->language)
                        {{ $language->title }}
                     @endif
                  @endforeach
               </p>
            </div>
            @auth
               @if (!Auth::user()->is_admin)
                  <div class="col-lg-2 text-right">
                     <a href="{{ route('movie.watch', $movie->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-play mr-2"></i>Watch Movie</a>
                  </div>
               @endif
            @else
               <div class="col-lg-2 text-right">
                  <a href="{{ route('movie.watch', $movie->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-play mr-2"></i>Watch Movie</a>
               </div>
            @endauth
          </div>
       </div>
       <div class="bg-white p-3 widget shadow rounded mb-4">
          <h4 class="text-gray-900 font-weight-bold">Summary</h4>
          <p>{{ $movie->summary }}</p>
       </div>
    </div>
 </div>
@endsection