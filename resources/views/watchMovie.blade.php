@extends('layouts.app')

@section('title', 'movie detail')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="mb-2">
                <video id="video" width="100%" height="500" controls style="background: black">
                    <source src="{{ $movie->movie_link }}" type="video/mp4">
                  </video>
            </div>
            <div class="mb-3">
                <h4 class="text-gray-900">{{ $movie->title }} {{ $movie->year }} ({{ $movie->language }})</h4>
                <p>{{ date('d M Y', strtotime($movie->release_date)) }}</p>
            </div>
            <hr>
            <div class="mb-4">
                <h6 class="text-gray-900">Region:</h6>
                <p>{{ $movie->region }}</p>
                <h6 class="text-gray-900">Directors:</h6>
                <p>{{ str_replace(',', ' / ', $movie->directors) }}</p>
                <h6 class="text-gray-900">Writers:</h6>
                <p>{{ str_replace(',', ' / ', $movie->writers) }}</p>
                <h6 class="text-gray-900">Cast:</h6>
                <p>{{ str_replace(',', ' / ', $movie->cast) }}</p>
                <h6 class="text-gray-900">Category :</h6>
                <p>
                  @foreach ($genres as $genre)
                    @if (in_array($genre->id, explode(',', $movie->genres)))
                      {{ $genre->title }} /
                    @endif
                  @endforeach
                  @foreach ($categories as $category)
                    @if (in_array($category->id, explode(',', $movie->category)))
                      {{ $category->title }} /
                    @endif
                  @endforeach
                </p>
                <h6 class="text-gray-900">Summary :</h6>
                <p>{{ $movie->summary }}</p>
                <h6 class="text-gray-900">Tags :</h6>
                <div class="d-flex">
                  @foreach ($genres as $genre)
                    @if (in_array($genre->id, explode(',', $movie->genres)))
                      <span class="badge badge-dark p-2 mr-2 font-weight-normal">{{ $genre->title }}</span>
                    @endif
                  @endforeach
                  @foreach ($categories as $category)
                    @if (in_array($category->id, explode(',', $movie->category)))
                      <span class="badge badge-dark p-2 mr-2 font-weight-normal">{{ $category->title }}</span>
                    @endif
                  @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="bg-secondary d-flex flex-column justify-content-center align-items-center text-light p-4 mb-3">
                            <span>Google AdSense</span>
                        </div>
                        <h6 class="text-gray-900">Up Next</h6>
                    </div>
                    <div class="col-md-12">
                        @foreach ($movies as $mov)

                            <div class="mb-3 d-flex">
                                <div style="position: relative">
                                    <a href="{{ route('movie.watch', $mov->id) }}"><img width="120" height="76" src="{{ $mov->cover ? asset('storage/'.$mov->cover) : $mov->cover_link }}" alt="{{ $mov->title }}" style="object-fit: cover"></a>
                                    <span class="badge badge-primary" style="position: absolute; bottom: 10px; right: 5px;">{{ $mov->duration }}</span>
                                </div>
                                <div class="ml-3">
                                    <a href="{{ route('movie.watch', $mov->id) }}">{{ $mov->title }} {{ $mov->year }}</a>
                                    <br>
                                    <small class="mt-1">
                                      @foreach ($languages as $language)
                                          @if ($language->id == $mov->language)
                                            {{ $language->title }}
                                          @endif
                                      @endforeach
                                      <i class="fas fa-calendar-alt ml-2"></i> {{ date('d M Y', strtotime($mov->release_date)) }}
                                    </small>
                                    <br>
                                    <small>
                                      @foreach ($genres as $genre)
                                        @if (in_array($genre->id, explode(',', $mov->genres)))
                                          {{ $genre->title }} /
                                        @endif
                                      @endforeach
                                      @foreach ($categories as $category)
                                        @if (in_array($category->id, explode(',', $mov->category)))
                                          {{ $category->title }} /
                                        @endif
                                      @endforeach
                                    </small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal --}}
    <div class="modal fade" id="ad-modal" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
            <p>Your AD</p>
            <button type="button" class="btn btn-primary" id="next-btn" disabled>Next</button>
            </div>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
  
    <div class="modal fade" id="claim-modal" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Claim Your Points</h4>
            </div>
            <div class="modal-body text-center">
            <p>claims and points will be stored to your wallet</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="claim-btn">Claim & Store to Wallet</button>
            </div>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('page-style')
    <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endsection

@section('page-script')
    <!-- SweetAlert2 -->
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
      var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
    </script>
    <script>
      const video = $('#video')
      let markers = []
      const adModal = $('#ad-modal')
      const claimModal = $('#claim-modal')
      const nextBtn = $('#next-btn')
      // const point = $('#balance-point')
    //   const wallet = $('#balance-wallet')
      // const modalPoint = $('#modal-point')
      const claimBtn = $('#claim-btn')
      // const claimUrl = `{{ url('api/wallet/${pointsObj.id}') }}`

      const startTimer = (duration, display) => {
          let timer = duration, seconds;
          const int = setInterval(function () {
              seconds = parseInt(timer % 60, 10);

              seconds = seconds < 10 ? "0" + seconds : seconds;

              display.text(`Continue in  ${seconds}s`);
              display.attr('disabled', true)
              
              if (--timer < 0) {
                  display.text('Next')
                  display.removeAttr('disabled')
                  clearInterval(int);
              }
          }, 1000);
      }

      const setMarkers = (duration) => {
        let markers = []

        while(markers.length < 3){
            var r = Math.floor(Math.random() * duration + 1);
            if(markers.indexOf(r) === -1) markers.push(r);
        }
        return markers.sort((a, b) => a - b)
      }

      video.on('canplay', (e) => {
        const duration = e.target.duration
        markers = setMarkers(duration)
      })

      video.on('timeupdate', (e) => {
            const currentTime = Math.floor(e.target.currentTime)

            if (markers.includes(currentTime)) {
                markers.shift()
                startTimer(3, nextBtn);
                adModal.modal('show')
                e.target.pause()
            }
      })

      video.on('ended', () => {
          claimModal.modal('show')
      })

      nextBtn.on('click', () => {
        fetch("{{ url('api/wallet') }}", {
          method: 'POST',
          headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': "{{ csrf_token() }}",
          },
          body: JSON.stringify({
            user_id: <?= Auth::user()->id ?>
          })
        })
          .then((res) => res.json())
          .then((json) => {
            adModal.modal('hide')
            nextBtn.attr('disabled', true)
            video.trigger('play')
          })
      })

      claimBtn.on('click', () => {
        fetch(`{{ url('api/wallet/') }}/{{ Auth::user()->id }}`, {
          method: 'PUT',
          headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': "{{ csrf_token() }}",
          }
        })
          .then((res) => res.json())
          .then((json) => {
            if (json.status == 'success') {
              claimModal.modal('hide')
              Toast.fire({
                icon: 'success',
                title: 'Points claimed and stored to wallet'
              })
            } else {
              // localStorage.setItem('video-points', 0)
              claimModal.modal('hide')
              Toast.fire({
                icon: 'error',
                title: json.message
              })
            }
          })
      })
      
    </script>
@endsection
