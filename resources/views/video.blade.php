@extends('layouts/main')

@section('title', 'demo video')

@section('page-title', 'Demo Video (Claim Points)')

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title d-flex justify-content-between" style="width: 100%">
            Demo Video
            <span>Wallet Balance: <span id="balance-wallet">{{ $userWallet[0]['wallet']}} </span> USD <small id="myr-wallet"></small></span>
            {{-- <span>Unclaimed Points: <span id="balance-point">{{ $userWallets->points }} </span> USD</span> --}}
          </h3>
        </div>
        <div class="card-body text-center">
          <div>
            <video id="video" height="500" controls>
              <source src="{{ asset('assets/video/explore.mp4') }}" type="video/mp4">
            </video>
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
      const wallet = $('#balance-wallet')
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
              wallet.text(json.data.wallet)
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

      if (<?= $userWallet[0]['wallet'] ?>) {
        fetch(`https://api.frankfurter.app/latest?amount={{ $userWallet[0]['wallet'] }}&from=USD&to=MYR`)
          .then(res => res.json())
          .then(json => $('#myr-wallet').text(`${json.rates.MYR} MYR`))
      }
      
    </script>
@endsection