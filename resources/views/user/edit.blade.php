@extends('layouts/main')

@section('title', 'edit user')

@section('page-title', 'Edit user')

@section('page-style')
    <!-- icheck bootstrap -->
<link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            Edit user
          </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('user.update', $user->id) }}" method="post">
                @csrf
                @method('PUT')
                  <input type="hidden" name="callback" value="user.index">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Full name" value="{{ $user->name }}">
                    @error('name')
                        <span class="invalid-feedback d-block m-0">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" value="{{ $user->username }}" disabled>
                    @error('username')
                        <span class="invalid-feedback d-block m-0">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group mt-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" disabled value="{{ $user->email }}" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <div class="icheck-primary">
                      <input type="checkbox" id="is_admin" name="is_admin" {{ $user->is_admin ? 'checked' : '' }}>
                      <label for="is_admin">
                        Is Admin
                      </label>
                    </div>
                  </div>
                
                  <a href="{{ url()->previous() }}" class="btn btn-light mr-2">Cancel</a>
                  <button type="submit" class="btn btn-primary">Save</button>
              </form>
        </div>
      </div>
    </div>
</div>
@endsection