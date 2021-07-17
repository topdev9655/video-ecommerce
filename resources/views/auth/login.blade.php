@extends('layouts.auth')

@section('title', 'login')

@section('content')
      <div class="bg-gradient-primary">
        <div class="container">
           <!-- Outer Row -->
           <div class="row justify-content-center align-items-center d-flex vh-100">
              <div class="col-xl-10 col-lg-12 col-md-9">
                 <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                       <!-- Nested Row within Card Body -->
                       <div class="row">
                          <div class="col-lg-6 d-none d-lg-block" style="background: url({{ asset('assets/client/img/login.jpg') }}); background-position: center; background-size: cover;"></div>
                          <div class="col-lg-6">
                             <div class="p-5">
                                <div class="text-center">
                                   <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible">
                                        {{ session('error') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    </div>
                                @endif
                                <form class="login" action="{{ route('login') }}" method="post">
                                  @csrf
                                   <div class="form-group">
                                      <input type="text" class="form-control form-control-user @error('username') is-invalid @enderror" name="username" placeholder="Enter username..." value="{{ old('username') }}">
                                      @error('username')
                                          <span class="invalid-feedback d-block">
                                              {{ $message }}
                                          </span>
                                      @enderror
                                   </div>
                                   <div class="form-group">
                                      <input type="password" class="form-control form-control-user  @error('password') is-invalid @enderror" name="password" placeholder="Password">
                                      @error('password')
                                          <span class="invalid-feedback d-block">
                                              {{ $message }}
                                          </span>
                                      @enderror
                                   </div>
                                   <div class="form-group">
                                      <div class="custom-control custom-checkbox small">
                                         <input type="checkbox" class="custom-control-input" name="remember" id="customCheck" {{ old('remember') ? 'checked' : '' }}>
                                         <label class="custom-control-label" for="customCheck">Remember Me</label>
                                      </div>
                                   </div>
                                   <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                </form>
                                <hr>
                                <div class="text-center">
                                  @if (Route::has('password.request'))
                                   <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                                  @endif
                                </div>
                                <div class="text-center">
                                   <a class="small" href="{{ route('register') }}">Create an Account!</a>
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
