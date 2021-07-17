@extends('layouts/main')

@section('title', 'add language')

@section('page-title', 'Add new language')

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            Add new language
          </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('language.store') }}" method="post">
                @csrf
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Language title" value="{{ old('title') }}">
                        @error('title')
                            <span class="invalid-feedback d-block m-0">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="description">Description</label>
                        <textarea type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback d-block m-0">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
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