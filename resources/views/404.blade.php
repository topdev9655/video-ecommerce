@extends('layouts.app')

@section('title', '404')
    
@section('content')
<div class="text-center pb-5">
    <div class="error mx-auto" data-text="404">404</div>
    <p class="lead text-gray-800 mb-5">Page Not Found</p>
    <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
    <a href="javascript:history.go(-1)">&larr; Back to Dashboard</a>
 </div>
@endsection