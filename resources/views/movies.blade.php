@extends('layouts.app')

@section('title', 'movies')

@section('page-script')
   <script>
      const genreFilters = $('[id^="genre-"]')
      const languageFilters = $('[id^="language-"]')
      const categoryFilters = $('[id^="category-"]')

      const getFilters = (e) => {
         const genre = []
         const language = []
         const category = []

         genreFilters.each(function () {
            if ($(this).is(':checked')) {
               genre.push($(this).attr('id').split('-')[1])
            }
         });
         languageFilters.each(function () {
            if ($(this).is(':checked')) {
               language.push($(this).attr('id').split('-')[1])
            }
         });
         categoryFilters.each(function () {
            if ($(this).is(':checked')) {
               category.push($(this).attr('id').split('-')[1])
            }
         });

         const d = {
            genre,
            language,
            category,
         }

         document.location.href = "<?= url('movies/') ?>/" + JSON.stringify(d);
      } 

      genreFilters.on('change', getFilters)
      languageFilters.on('change', getFilters)
      categoryFilters.on('change', getFilters)

   </script>
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mt-4 mb-3">
        <h1 class="h5 mb-0 text-gray-900">Movies</h1>
        <a href="{{ route('movies') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Reset Filters <i class="fas fa-times fa-sm text-white-50 ml-2"></i></a>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-3 col-lg-4">
            <div class="filters mobile-filters shadow rounded bg-white mb-4">
                <div class="border-bottom">
                    <a class="h6 font-weight-bold text-dark d-block m-0 p-3" data-toggle="collapse" href="#mobile-filters"
                        role="button" aria-expanded="false" aria-controls="mobile-filters">
                        Filter By
                        <i class="fas fa-angle-down float-right mt-1"></i>
                    </a>
                </div>
                <div id="mobile-filters" class="filters-body collapse show multi-collapse">
                    <div id="accordion">
                        <div class="filters-card border-bottom p-3">
                            <div class="filters-card-header" id="headingTwo">
                                <h6 class="mb-0">
                                    <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapsetwo"
                                        aria-expanded="true" aria-controls="collapsetwo">
                                        Genre
                                        <i class="fas fa-angle-down float-right"></i>
                                    </a>
                                </h6>
                            </div>
                            <div id="collapsetwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="filters-card-body card-shop-filters">
                                    {{-- <form class="filters-search mb-3">
                            <div class="form-group">
                               <i class="fas fa-search"></i>
                               <input type="text" class="form-control" placeholder="Start typing to search...">
                            </div>
                         </form> --}}
                                    @foreach ($genres as $genre)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="genre-{{ $genre->id }}" {{ $filter && in_array($genre->id, $filter->genre) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="genre-{{ $genre->id }}">{{ $genre->title }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="filters-card border-bottom p-3">
                            <div class="filters-card-header" id="headingOne">
                                <h6 class="mb-0">
                                    <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        Select Language <i class="fas fa-angle-down float-right"></i>
                                    </a>
                                </h6>
                            </div>
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="filters-card-body card-shop-filters">
                                    @foreach ($languages as $language)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                id="language-{{ $language->id }}" {{ $filter && in_array($language->id, $filter->language) ? 'checked' : '' }}>
                                            <label class="custom-control-label"
                                                for="language-{{ $language->id }}">{{ $language->title }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="filters-card border-bottom p-3">
                            <div class="filters-card-header" id="headingOffer">
                                <h6 class="mb-0">
                                    <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseOffer"
                                        aria-expanded="true" aria-controls="collapseOffer">
                                        Format <i class="fas fa-angle-down float-right"></i>
                                    </a>
                                </h6>
                            </div>
                            <div id="collapseOffer" class="collapse" aria-labelledby="headingOffer"
                                data-parent="#accordion">
                                <div class="filters-card-body card-shop-filters">
                                    @foreach ($categories as $category)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                id="category-{{ $category->id }}" {{ $filter && in_array($category->id, $filter->category) ? 'checked' : '' }}>
                                            <label class="custom-control-label"
                                                for="category-{{ $category->id }}">{{ $category->title }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="filters shadow rounded bg-white mb-3 d-none d-sm-none d-md-block">
          <div class="filters-header border-bottom p-3">
             <h6 class="m-0 text-dark">Filter By</h6>
          </div>
          <div class="filters-body">
            @section('filter')
                @include('layouts/parts/filter')
            @show
          </div>
       </div> --}}
        </div>
        <div class="col-xl-9 col-lg-8">
            <div class="row">
                @if ($movies->count() > 0)
                    @foreach ($movies as $movie)
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card m-card shadow border-0">
                                <a href="{{ route('movie.detail', $movie->id) }}">
                                    <div class="m-card-cover">
                                        {{-- <div class="position-absolute bg-white shadow-sm rounded text-center p-2 m-2 love-box">
                            <h6 class="text-gray-900 mb-0 font-weight-bold"><i class="fas fa-heart text-danger"></i> 88%</h6>
                            <small class="text-muted">23,421</small>
                            </div> --}}
                                        <img src="{{ $movie->poster ? asset('storage/' . $movie->poster) : $movie->poster_link }}"
                                            class="card-img-top" alt="movie-poster-{{ $movie->title }}" height="518"
                                            style="object-fit: cover">
                                    </div>
                                    <div class="card-body p-3">
                                        <h5 class="card-title text-gray-900 mb-1">{{ $movie->title }}</h5>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                @foreach ($languages as $language)
                                                    @if ($language->id == $movie->language)
                                                        {{ $language->title }}
                                                    @endif
                                                @endforeach
                                            </small>
                                            <small class="text-danger"><i
                                                    class="fas fa-calendar-alt fa-sm text-gray-400 ml-2"></i>
                                                {{ date('d M Y', strtotime($movie->release_date)) }}</small>
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    @for ($i = 0; $i < 3; $i++)
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card m-card shadow border-0">
                                <div>
                                <div class="m-card-cover">
                                    <img src="{{ asset('assets/client/img/m4.jpg') }}" class="card-img-top" alt="movie-empty" height="518" style="object-fit: cover">
                                </div>
                                <div class="card-body p-3">
                                    <div class="card-title mb-1" style="height: 15px; width: 100%; background: #d3d3d3;"></div>
                                    <div class="card-text" style="height: 10px; width: 30%; background: #d3d3d3;"></div>
                                </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>
@endsection
