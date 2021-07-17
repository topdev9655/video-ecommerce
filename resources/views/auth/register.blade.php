@extends('layouts.auth')

@section('title', 'register')

@section('content')

  <div class="bg-gradient-primary">
    <div class="container">

    <div class="row justify-content-center align-items-center d-flex vh-100">
       <div class="col-xl-10 col-lg-12 col-md-9">
          <div class="card o-hidden border-0 shadow-lg my-5">
             <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                   <div class="col-lg-5 d-none d-lg-block" style="background: url({{ asset('assets/client/img/login3.jpg') }}); background-position: center; background-size: cover;"></div>
                   <div class="col-lg-7">
                      <div class="p-5">
                         <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                         </div>
                         <form class="user" action="{{ route('register') }}" method="post">
                           @csrf
                            <div class="form-group">
                               <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ old('name') }}">
                                 @error('name')
                                    <span class="invalid-feedback d-block">
                                          <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                            </div>
                            <div class="form-group">
                               <input type="text" class="form-control form-control-user @error('username') is-invalid @enderror" name="username" placeholder="Username" value="{{ old('username') }}">
                                 @error('username')
                                    <span class="invalid-feedback d-block">
                                          <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                            </div>
                            <div class="form-group">
                               <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email Address">
                                 @error('email')
                                    <span class="invalid-feedback d-block">
                                          <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                            </div>
                            <div class="form-group row">
                               <div class="col-sm-6 mb-3 mb-sm-0">
                                  <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" placeholder="Password">
                                    @error('password')
                                       <span class="invalid-feedback d-block">
                                             <strong>{{ $message }}</strong>
                                       </span>
                                    @enderror
                               </div>
                               <div class="col-sm-6">
                                  <input type="password" class="form-control form-control-user" name="password_confirmation" placeholder="Repeat Password">
                               </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                            Register Account
                            </button>
                         </form>
                         <hr>
                         <div class="text-center">
                                  @if (Route::has('password.request'))
                            <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                                  @endif
                         </div>
                         <div class="text-center">
                            <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
</div>
@endsection
