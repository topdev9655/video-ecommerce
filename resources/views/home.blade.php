@extends('layouts/app')

@section('title', 'home')

@section('content')
    @if ($movies->count() > 0)
        <div class="osahan-slider">
            @foreach ($movies as $movie)
            <div class="osahan-slider-item"><img src="{{ $movie->cover ? asset('storage/'.$movie->cover) : $movie->cover_link }}" class="img-fluid rounded" alt="movie-cover-{{ $movie->title }}"></div>
            @endforeach
        </div>
    @else
        <div class="osahan-slider">
            @for ($i = 0; $i < 3; $i++)
            <div class="osahan-slider-item"><img src="{{ asset('assets/client/img/slider1.jpg') }}" class="img-fluid rounded" alt="movie-empty"></div>
            @endfor
        </div>
    @endif
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mt-4 mb-3">
        <h1 class="h5 mb-0 text-gray-900">Movies</h1>
        <a href="{{ route('movies') }}" class="d-none d-sm-inline-block text-xs">View All <i class="fas fa-eye fa-sm"></i></a>
    </div>
    <!-- Content Row -->
    <div class="row">
        @if ($movies->count() > 0)
            @foreach ($movies as $movie)
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card m-card shadow border-0">
                        <a href="{{ route('movie.detail', $movie->id) }}">
                        <div class="m-card-cover">
                            {{-- <div class="position-absolute bg-white shadow-sm rounded text-center p-2 m-2 love-box">
                                <h6 class="text-gray-900 mb-0 font-weight-bold"><i class="fas fa-heart text-danger"></i> 88%</h6>
                                <small class="text-muted">23,421</small>
                            </div> --}}
                            <img src="{{ $movie->poster ? asset('storage/'.$movie->poster) : $movie->poster_link }}" class="card-img-top" alt="movie-poster-{{ $movie->title }}" height="518" style="object-fit: cover">
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
                                <small class="text-danger"><i class="fas fa-calendar-alt fa-sm text-gray-400 ml-2"></i> {{ date('d M Y', strtotime($movie->release_date)) }}</small> </p>
                        </div>
                        </a>
                    </div>
                </div>
            @endforeach
        @else
            @for ($i = 0; $i < 4; $i++)
                <div class="col-xl-3 col-md-6 mb-4">
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
        {{-- <div class="col-xl-3 col-md-6 mb-4">
            <div class="card m-card shadow border-0">
                <a href="{{ route('movie.detail', 1) }}">
                <div class="m-card-cover">
                    <div class="position-absolute bg-white shadow-sm rounded text-center p-2 m-2 love-box">
                        <h6 class="text-gray-900 mb-0 font-weight-bold"><i class="fas fa-heart text-danger"></i> 50%</h6>
                        <small class="text-muted">8,784</small>
                    </div>
                    <img src="{{ asset('assets/client/img/m2.jpg') }}" class="card-img-top" alt="...">
                </div>
                <div class="card-body p-3">
                    <h5 class="card-title text-gray-900 mb-1">Gemini Man</h5>
                    <p class="card-text"><small class="text-muted">English</small> <small class="text-danger"><i class="fas fa-calendar-alt fa-sm text-gray-400"></i> 22 AUG</small> </p>
                </div>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card m-card shadow border-0">
                <a href="{{ route('movie.detail', 1) }}">
                <div class="m-card-cover">
                    <div class="position-absolute bg-white shadow-sm rounded text-center p-2 m-2 love-box">
                        <h6 class="text-gray-900 mb-0 font-weight-bold"><i class="fas fa-heart text-danger"></i> 20%</h6>
                        <small class="text-muted">69,123</small>
                    </div>
                    <img src="{{ asset('assets/client/img/m3.jpg') }}" class="card-img-top" alt="...">
                </div>
                <div class="card-body p-3">
                    <h5 class="card-title text-gray-900 mb-1">The Current War</h5>
                    <p class="card-text"><small class="text-muted">English</small> <small class="text-danger"><i class="fas fa-calendar-alt fa-sm text-gray-400"></i> 22 AUG</small> </p>
                </div>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card m-card shadow border-0">
                <a href="{{ route('movie.detail', 1) }}">
                <div class="m-card-cover">
                    <div class="position-absolute bg-white shadow-sm rounded text-center p-2 m-2 love-box">
                        <h6 class="text-gray-900 mb-0 font-weight-bold"><i class="fas fa-heart text-danger"></i> 74%</h6>
                        <small class="text-muted">88,865</small>
                    </div>
                    <img src="{{ asset('assets/client/img/m4.jpg') }}" class="card-img-top" alt="...">
                </div>
                <div class="card-body p-3">
                    <h5 class="card-title text-gray-900 mb-1">Charlie's Angels</h5>
                    <p class="card-text"><small class="text-muted">English</small> <small class="text-danger"><i class="fas fa-calendar-alt fa-sm text-gray-400"></i> 22 AUG</small> </p>
                </div>
                </a>
            </div>
        </div> --}}
    </div>
    <!-- Page Heading -->
    {{-- <div class="d-sm-flex align-items-center justify-content-between mt-1 mb-3">
        <h1 class="h5 mb-0 text-gray-900">Collections</h1>
    </div> --}}
    <!-- Content Row -->
    {{-- <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="collections-slider">
                <div class="card c-card shadow border-0 overflow-hidden">
                <a href="#"><img src="{{ asset('assets/client/img/c1.jpg') }}" class="img-fluid" alt="..."></a>
                </div>
                <div class="card c-card shadow border-0 overflow-hidden">
                <a href="#"><img src="{{ asset('assets/client/img/c2.jpg') }}" class="img-fluid" alt="..."></a>
                </div>
                <div class="card c-card shadow border-0 overflow-hidden">
                <a href="#"><img src="{{ asset('assets/client/img/c3.jpg') }}" class="img-fluid" alt="..."></a>
                </div>
                <div class="card c-card shadow border-0 overflow-hidden">
                <a href="#"><img src="{{ asset('assets/client/img/c4.jpg') }}" class="img-fluid" alt="..."></a>
                </div>
                <div class="card c-card shadow border-0 overflow-hidden">
                <a href="#"><img src="{{ asset('assets/client/img/c5.jpg') }}" class="img-fluid" alt="..."></a>
                </div>
                <div class="card c-card shadow border-0 overflow-hidden">
                <a href="#"><img src="{{ asset('assets/client/img/c2.jpg') }}" class="img-fluid" alt="..."></a>
                </div>
                <div class="card c-card shadow border-0 overflow-hidden">
                <a href="#"><img src="{{ asset('assets/client/img/c3.jpg') }}" class="img-fluid" alt="..."></a>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Page Heading -->
    {{-- <div class="d-sm-flex align-items-center justify-content-between mt-1 mb-3">
        <h1 class="h5 mb-0 text-gray-900">Events</h1>
        <a href="events.html" class="d-none d-sm-inline-block text-xs">View All <i class="fas fa-eye fa-sm"></i></a>
    </div> --}}
    <!-- Content Row -->
    {{-- <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card e-card shadow border-0">
                <a href="events-detail.html">
                <div class="m-card-cover">
                    <img src="{{ asset('assets/client/img/e1.jpg') }}" class="card-img-top" alt="...">
                </div>
                <div class="card-body p-0">
                    <div class="row no-gutters align-items-center">
                        <div class="col-2 auto py-3 pl-3">
                            <div class="bg-white rounded text-center">
                            <h6 class="text-danger mb-0 font-weight-bold">07</h6>
                            <small class="text-muted">OCT</small>
                            </div>
                        </div>
                        <div class="col-10 p-3">
                            <p class="card-text text-gray-900 mb-1">Glasgow International Comedy Festival</p>
                            <p class="card-text"><small class="text-muted"><i class="fas fa-map-marker-alt fa-sm ml-1"></i> Glasgow, Scotland</small></p>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card e-card shadow border-0">
                <a href="events-detail.html">
                <div class="m-card-cover">
                    <img src="{{ asset('assets/client/img/e2.jpg') }}" class="card-img-top" alt="...">
                </div>
                <div class="card-body p-0">
                    <div class="row no-gutters align-items-center">
                        <div class="col-2 auto py-3 pl-3">
                            <div class="bg-white rounded text-center">
                            <h6 class="text-danger mb-0 font-weight-bold">10</h6>
                            <small class="text-muted">OCT</small>
                            </div>
                        </div>
                        <div class="col-10 p-3">
                            <p class="card-text text-gray-900 mb-1">Vancouver Fashion Week</p>
                            <p class="card-text"><small class="text-muted"><i class="fas fa-map-marker-alt fa-sm ml-1"></i> Vancouver, Canada</small></p>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card e-card shadow border-0">
                <a href="events-detail.html">
                <div class="m-card-cover">
                    <img src="{{ asset('assets/client/img/e3.jpg') }}" class="card-img-top" alt="...">
                </div>
                <div class="card-body p-0">
                    <div class="row no-gutters align-items-center">
                        <div class="col-2 auto py-3 pl-3">
                            <div class="bg-white rounded text-center">
                            <h6 class="text-danger mb-0 font-weight-bold">15</h6>
                            <small class="text-muted">OCT</small>
                            </div>
                        </div>
                        <div class="col-10 p-3">
                            <p class="card-text text-gray-900 mb-1">DC Environmental Film Festival</p>
                            <p class="card-text"><small class="text-muted"><i class="fas fa-map-marker-alt fa-sm ml-1"></i> Washington DC, USA</small></p>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card e-card shadow border-0">
                <a href="events-detail.html">
                <div class="m-card-cover">
                    <img src="{{ asset('assets/client/img/e4.jpg') }}" class="card-img-top" alt="...">
                </div>
                <div class="card-body p-0">
                    <div class="row no-gutters align-items-center">
                        <div class="col-2 auto py-3 pl-3">
                            <div class="bg-white rounded text-center">
                            <h6 class="text-danger mb-0 font-weight-bold">22</h6>
                            <small class="text-muted">OCT</small>
                            </div>
                        </div>
                        <div class="col-10 p-3">
                            <p class="card-text text-gray-900 mb-1">Cape Town International Jazz Festival</p>
                            <p class="card-text"><small class="text-muted"><i class="fas fa-map-marker-alt fa-sm ml-1"></i> Cape Town, South Africa</small></p>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div> --}}
    <!-- Page Heading -->
    {{-- <div class="d-sm-flex align-items-center justify-content-between mt-1 mb-3">
        <h1 class="h5 mb-0 text-gray-900">Sports</h1>
        <a href="sports.html" class="d-none d-sm-inline-block text-xs">View All <i class="fas fa-eye fa-sm"></i></a>
    </div> --}}
    <!-- Content Row -->
    {{-- <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card e-card shadow border-0">
                <a href="sports-detail.html">
                <div class="m-card-cover">
                    <img src="{{ asset('assets/client/img/s1.jpg') }}" class="card-img-top" alt="...">
                </div>
                <div class="card-body p-0">
                    <div class="row no-gutters align-items-center">
                        <div class="col-2 auto py-3 pl-3">
                            <div class="bg-white rounded text-center">
                            <h6 class="text-danger mb-0 font-weight-bold">25</h6>
                            <small class="text-muted">OCT</small>
                            </div>
                        </div>
                        <div class="col-10 p-3">
                            <p class="card-text text-gray-900 mb-1">The FIFA World Cup</p>
                            <p class="card-text"><small class="text-muted"><i class="fas fa-map-marker-alt fa-sm ml-1"></i> Glasgow, Scotland</small></p>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card e-card shadow border-0">
                <a href="sports-detail.html">
                <div class="m-card-cover">
                    <img src="{{ asset('assets/client/img/s2.jpg') }}" class="card-img-top" alt="...">
                </div>
                <div class="card-body p-0">
                    <div class="row no-gutters align-items-center">
                        <div class="col-2 auto py-3 pl-3">
                            <div class="bg-white rounded text-center">
                            <h6 class="text-danger mb-0 font-weight-bold">28</h6>
                            <small class="text-muted">OCT</small>
                            </div>
                        </div>
                        <div class="col-10 p-3">
                            <p class="card-text text-gray-900 mb-1">The Olympic Games</p>
                            <p class="card-text"><small class="text-muted"><i class="fas fa-map-marker-alt fa-sm ml-1"></i> United States</small></p>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card e-card shadow border-0">
                <a href="sports-detail.html">
                <div class="m-card-cover">
                    <img src="{{ asset('assets/client/img/s3.jpg') }}" class="card-img-top" alt="...">
                </div>
                <div class="card-body p-0">
                    <div class="row no-gutters align-items-center">
                        <div class="col-2 auto py-3 pl-3">
                            <div class="bg-white rounded text-center">
                            <h6 class="text-danger mb-0 font-weight-bold">12</h6>
                            <small class="text-muted">NOV</small>
                            </div>
                        </div>
                        <div class="col-10 p-3">
                            <p class="card-text text-gray-900 mb-1">The 24 Hours of Le Mans</p>
                            <p class="card-text"><small class="text-muted"><i class="fas fa-map-marker-alt fa-sm ml-1"></i> France</small></p>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card e-card shadow border-0">
                <a href="sports-detail.html">
                <div class="m-card-cover">
                    <img src="{{ asset('assets/client/img/s4.jpg') }}" class="card-img-top" alt="...">
                </div>
                <div class="card-body p-0">
                    <div class="row no-gutters align-items-center">
                        <div class="col-2 auto py-3 pl-3">
                            <div class="bg-white rounded text-center">
                            <h6 class="text-danger mb-0 font-weight-bold">21</h6>
                            <small class="text-muted">NOV</small>
                            </div>
                        </div>
                        <div class="col-10 p-3">
                            <p class="card-text text-gray-900 mb-1">The Super Bowl</p>
                            <p class="card-text"><small class="text-muted"><i class="fas fa-map-marker-alt fa-sm ml-1"></i> United States</small></p>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
    <div class="text-center mt-1 mb-4">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div> --}}
@endsection