@extends('layouts/app')

@section('title', 'profile')

@section('content')
<section class="pt-5 pb-5 bg-gradient-primary text-white pl-4 pr-4 inner-profile mb-4">
    <div class="row gutter-2 gutter-md-4 align-items-end">
       <div class="col-md-4 text-center text-md-left">
          <h1 class="mb-1">{{ Auth::user()->name }}</h1>
          <span class="text-muted text-gray-500"><i class="fas fa-map-marker-alt fa-fw fa-sm mr-1"></i> India, Punjab</span>
       </div>
       <div class="col-md-4 text-center">
          <h4 class="m-0 font-weight-bold">Wallet Balance</h4>
          <h4 class="m-0">{{ $wallet[0]['wallet'] }} USD</h4>
       </div>
       <div class="col-md-4 text-center text-md-right">
          <a href="#" data-toggle="modal" data-target="#logoutModal" class="btn btn btn-light">Sign out</a>
       </div>
    </div>
 </section>
 <div class="row">
    <div class="col-xl-3 col-lg-3">
       <div class="bg-white p-3 widget shadow rounded mb-4">
          <div class="nav nav-pills flex-column lavalamp" id="sidebar-1" role="tablist">
             <a class="nav-link active" data-toggle="tab" href="#sidebar-1-1" role="tab"  aria-controls="sidebar-1" aria-selected="true"><i class="fas fa-wallet fa-sm fa-fw mr-2 text-gray-400"></i> Wallet</a>
             <a class="nav-link" data-toggle="tab" href="#sidebar-1-2" role="tab"  aria-controls="sidebar-1-2" aria-selected="false"><i class="fas fa-user-circle fa-sm fa-fw mr-2 text-gray-400"></i> Profile</a>
             <a class="nav-link" data-toggle="tab" href="#sidebar-1-3" role="tab" aria-controls="sidebar-1-3" aria-selected="false"><i class="fas fa-cog fa-sm fa-fw mr-2 text-gray-400"></i> Account Settings</a>
             <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout</a>
          </div>
       </div>
    </div>
    <div class="col-xl-9 col-lg-9">
       <div class="bg-white p-3 widget shadow rounded mb-4">
          <div class="tab-content" id="myTabContent">
             <!-- wallet -->
             <div class="tab-pane fade show active" id="sidebar-1-1" role="tabpanel" aria-labelledby="sidebar-1-1">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-3">
                   <h1 class="h5 mb-0 text-gray-900">Wallet</h1>
                   <button type="button" class="btn btn-primary" id="withdrawBtn">Withdraw money</button>
                </div>
                <div class="row">
                   <div class="col-md-6">
                      <div class="card card-body text-center">
                        <h5>USD</h5>
                        <h4 class="text-gray-900">${{ $wallet[0]['wallet'] }}</h4>
                      </div>
                   </div>
                   <div class="col-md-6">
                      <div class="card card-body text-center">
                        <h5>MYR</h5>
                        <h4 class="text-gray-900" id="myr-wallet">RM0</h4>
                      </div>
                   </div>
                </div>
             </div>
             <!-- profile -->
             <div class="tab-pane fade" id="sidebar-1-2" role="tabpanel" aria-labelledby="sidebar-1-2">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-3">
                   <h1 class="h5 mb-0 text-gray-900">Profile</h1>
                </div>
                  @if (session('message'))
                     <div class="alert alert-success alert-dismissible">
                        {{ session('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                     </div>
                  @endif
                <form class="form-horizontal" action="{{ route('profile.update', Auth::user()->id) }}" method="post">
                  @csrf
                  @method('PUT')
                  <input type="hidden" name="callback" value="profile">
                  <div class="row gutter-1">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label for="exampleInput1">Name</label>
                           <input id="exampleInput1" type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="First name" value="{{ Auth::user()->name }}">
                           @error('name')
                              <span class="invalid-feedback d-block m-0">
                                    <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group">
                           <label for="exampleInput2">Username</label>
                           <input id="exampleInput2" type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Username" value="{{ Auth::user()->username }}" disabled>
                           @error('username')
                              <span class="invalid-feedback d-block m-0">
                                    <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group">
                           <label for="exampleInput7">Email</label>
                           <input id="exampleInput7" type="email" class="form-control" placeholder="Email" value="{{ Auth::user()->email }}" disabled>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                     </div>
                  </div>
                </form>
             </div>
             <!-- payments -->
             <div class="tab-pane fade" id="sidebar-1-3" role="tabpanel" aria-labelledby="sidebar-1-3">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-3">
                   <h1 class="h5 mb-0 text-gray-900">Account Settings</h1>
                </div>
                <div class="row gutter-1">
                   <div class="col-12">
                      <div class="form-group">
                         <label for="exampleInput8">Old Password</label>
                         <input id="exampleInput8" type="password" class="form-control" placeholder="Password">
                      </div>
                   </div>
                   <div class="col-md-6">
                      <div class="form-group">
                         <label for="exampleInput9">New Password</label>
                         <input id="exampleInput9" type="password" class="form-control" placeholder="Password">
                      </div>
                   </div>
                   <div class="col-md-6">
                      <div class="form-group">
                         <label for="exampleInput10">Retype New Password</label>
                         <input id="exampleInput10" type="password" class="form-control" placeholder="Password">
                      </div>
                   </div>
                </div>
                <div class="row">
                   <div class="col">
                      <a href="#!" class="btn btn-primary">Save Changes</a>
                   </div>
                </div>
             </div>
          </div>
          <!-- / content -->
       </div>
    </div>
 </div>

{{-- withdraw modal --}}
<div class="modal fade" id="withdrawModal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Withdraw money</h5>
               <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
               </button>
            </div>
            <form id="withdraw-form" action="#" method="POST">
               @csrf
               <div class="modal-body">
                  <div class="form-group">
                     <label for="wallet">Your Wallet</label>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="input-group">
                              <div class="input-group-prepend">
                                 <span class="input-group-text">$</span>
                              </div>
                              <input type="text" class="form-control" value="{{ $wallet[0]['wallet'] }}" disabled>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="input-group">
                              <div class="input-group-prepend">
                                 <span class="input-group-text">RM</span>
                              </div>
                              <input type="text" id="wallet" class="form-control" disabled>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="amount">Withdraw Amount</label>
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text">RM</span>
                        </div>
                        <input type="number" min="50" step=".01" id="amount" class="form-control" name="amount">
                     </div>
                     <span class="form-text text-muted">min amount RM 50</span>
                  </div>
                  <div class="form-group">
                     <label for="turnover">Turnover</label>
                     <select id="turnover" class="form-control" name="turnover">
                        <option value="5">5X</option>
                        <option value="10">10X</option>
                        <option value="15">15X</option>
                        <option value="20">20X</option>
                        <option value="30">30X</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="receive">You Will Receive</label>
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text">RM</span>
                        </div>
                        <input type="text" id="receive" class="form-control" disabled>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <button class="btn btn-primary" type="submit">Withdraw</button>
               </div>
            </form>
      </div>
   </div>
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
   const wallet = <?= $wallet[0]['wallet'] ?? 0; ?>;
   let walletMYR = 0

   if (wallet > 0) {
     fetch(`https://api.frankfurter.app/latest?amount=<?= $wallet[0]['wallet'] ?>&from=USD&to=MYR`)
       .then(res => res.json())
       .then(json => {
          walletMYR = json.rates.MYR
          $('#myr-wallet').text(`RM${json.rates.MYR}`)
         })
   }

   $('#withdrawBtn').on('click', () => {
      if (walletMYR >= 50) {
         $('#wallet').val(walletMYR)
         $('#amount').attr('max', walletMYR).val(walletMYR)
         calculateWithdraw()
         $('#withdrawModal').modal('show')
      } else {
         Toast.fire({
            icon: 'error',
            title: 'you must have a minimum of RM50 to make a withdrawal'
         })
      }
   })

   const calculateWithdraw = () => {
      const turnover = $('#turnover').val()
      const amount = $('#amount').val()

      $('#receive').val(+turnover + +amount)
   }

   $('#amount').on('change', function () {
      calculateWithdraw()
   })
   $('#turnover').on('change', function () {
      calculateWithdraw()
   })
 </script>
@endsection