@extends('layouts/main')

@section('title', '500')

@section('content')
<div class="error-page">
    <h2 class="headline text-warning"> 404</h2>

    <div class="error-content">
      <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>

      <p>
        We could not find the page you were looking for.
        Meanwhile, you may <a href="{{ route('dashboard') }}">return to dashboard.</a>
      </p>

    </div>
    <!-- /.error-content -->
  </div>
@endsection