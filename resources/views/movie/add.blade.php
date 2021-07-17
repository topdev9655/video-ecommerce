@extends('layouts/main')

@section('title', 'add movie')

@section('page-title', 'Add new movie')

@section('page-style')
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('page-script')
{{-- moment --}}
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
  // datetimepicker
    $('#year').datetimepicker({
        format: 'Y',
        viewMode: 'years'
    });
    $('#release_date').datetimepicker({
        format: 'Y-MM-DD',
    });
    $('.select2bs4-single').select2({
      theme: 'bootstrap4',
    })
    $('.select2bs4').select2({
      theme: 'bootstrap4',
      multiple: true,
      tokenSeparators: [',']
    })
    $('.select2bs4-tag').select2({
      theme: 'bootstrap4',
      tags: true,
      multiple: true,
      tokenSeparators: [',']
    })
</script>
@endsection

@section('content')
<?php
function searchForId($id, $array) {
  foreach ($array as $key => $val) {
      if ($val === $id) {
          return $key;
      }
  }
  return null;
}
?>

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            Add new movie
          </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('movie.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Full title" value="{{ old('title') }}">
                        @error('title')
                            <span class="invalid-feedback d-block m-0">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-lg-2">
                      <div class="form-group">
                        <label for="year">Year</label>
                        <input type="text" name="year" class="form-control date @error('year') is-invalid @enderror" id="year" data-target="#year" data-toggle="datetimepicker"  value="{{ old('year') }}"/>
                        @error('year')
                            <span class="invalid-feedback d-block m-0">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-lg-2">
                      <div class="form-group">
                        <label for="release_date">Release Date</label>
                        <input type="text" name="release_date" class="form-control date @error('release_date') is-invalid @enderror" id="release_date" data-target="#release_date" data-toggle="datetimepicker"  value="{{ old('release_date') }}"/>
                        @error('release_date')
                            <span class="invalid-feedback d-block m-0">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-lg-2">
                      <div class="form-group">
                        <label>Duration</label>
                        <div class="input-group">
                          <input type="number" class="form-control @error('duration_hour') is-invalid @enderror" min="0" name="duration_hour" value="{{ old('duration_hour') ?? 0 }}">
                          <div class="input-group-prepend input-group-append">
                            <span class="input-group-text">:</span>
                          </div>
                          <input type="number" class="form-control @error('duration_min') is-invalid @enderror" min="0" name="duration_min" value="{{ old('duration_min') ?? 0 }}">
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="region">Region</label>
                        <input type="text" name="region" id="region" class="form-control @error('region') is-invalid @enderror" placeholder="Region" value="{{ old('region') }}">
                        @error('region')
                            <span class="invalid-feedback d-block m-0">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="language">Language</label>
                        <select class="select2bs4-single w-100 @error('language') is-invalid @enderror" name="language" data-placeholder="language">
                        @foreach ($languages as $language)
                          @if (old('language'))
                            <option value="{{ $language->id }}" {{ $language->id == old('language') ? 'selected' : '' }}>{{ $language->title }}</option>  
                          @else
                            <option value="{{ $language->id }}">{{ $language->title }}</option>  
                          @endif
                        @endforeach
                        </select>
                        @error('language')
                            <span class="invalid-feedback d-block m-0">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="category">Category</label>
                        <select class="select2bs4 w-100 @error('category') is-invalid @enderror" name="category[]" multiple="multiple" data-placeholder="Category">
                        @foreach ($categories as $category)
                          @if (is_array(old('category')))
                            <option value="{{ $category->id }}" {{ in_array($category->id, old('category')) ? 'selected' : '' }}>{{ $category->title }}</option>  
                          @else
                            <option value="{{ $category->id }}">{{ $category->title }}</option>  
                          @endif
                        @endforeach
                        </select>
                        @error('category')
                            <span class="invalid-feedback d-block m-0">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="genres">Genre</label>
                        <select class="select2bs4 w-100 @error('genres') is-invalid @enderror" name="genres[]" multiple="multiple" data-placeholder="Genres">
                          @foreach ($genres as $genre)
                            @if (is_array(old('genres')))
                              <option value="{{ $genre->id }}" {{ in_array($genre->id, old('genres')) ? 'selected' : '' }}>{{ $genre->title }}</option>  
                            @else
                              <option value="{{ $genre->id }}">{{ $genre->title }}</option>  
                            @endif
                          @endforeach
                        </select>
                        @error('genres')
                        <span class="invalid-feedback d-block m-0">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="directors">Directors</label>
                        <select class="select2bs4-tag w-100 @error('directors') is-invalid @enderror" name="directors[]" multiple="multiple" data-placeholder="Directors">
                        @if (is_array(old('directors')))
                            @foreach (old('directors') as $directors)
                                <option value="{{ $directors }}" selected>{{ $directors }}</option>
                            @endforeach
                        @endif
                        </select>
                        @error('directors')
                        <span class="invalid-feedback d-block m-0">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="writers">Writers</label>
                        <select class="select2bs4-tag w-100 @error('writers') is-invalid @enderror" name="writers[]" multiple="multiple" data-placeholder="Writers">
                        @if (is_array(old('writers')))
                            @foreach (old('writers') as $writers)
                                <option value="{{ $writers }}" selected>{{ $writers }}</option>
                            @endforeach
                        @endif
                        </select>
                        @error('writers')
                        <span class="invalid-feedback d-block m-0">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="cast">Casts</label>
                        <select class="select2bs4-tag w-100 @error('cast') is-invalid @enderror" name="cast[]" multiple="multiple" data-placeholder="Casts">
                        @if (is_array(old('cast')))
                            @foreach (old('cast') as $cast)
                                <option value="{{ $cast }}" selected>{{ $cast }}</option>
                            @endforeach
                        @endif
                        </select>
                        @error('cast')
                        <span class="invalid-feedback d-block m-0">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="plot">Plot</label>
                        <textarea type="text" name="plot" id="plot" rows="3" class="form-control @error('plot') is-invalid @enderror" placeholder="Plot">{{ old('plot') }}</textarea>
                        @error('plot')
                            <span class="invalid-feedback d-block m-0">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="summary">Summary</label>
                        <textarea type="text" name="summary" id="summary" rows="7" class="form-control @error('summary') is-invalid @enderror" placeholder="Summary">{{ old('summary') }}</textarea>
                        @error('summary')
                            <span class="invalid-feedback d-block m-0">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="movie_link">Movie Link</label>
                        <input type="text" name="movie_link" id="movie_link" class="form-control @error('movie_link') is-invalid @enderror" placeholder="movie link" value="{{ old('movie_link') }}">
                        @error('movie_link')
                            <span class="invalid-feedback d-block m-0">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="poster">Poster</label>
                        <input type="file" class="form-control mb-3 @error('poster') is-invalid @enderror" name="poster" id="poster-input-file" value="{{ old('poster') }}">
                        <input type="text" name="poster_link" id="poster-link" class="form-control @error('poster_link') is-invalid @enderror" placeholder="Poster Link" value="{{ old('poster_link') }}">
                        <span class="form-text text-muted">fill in only one field</span>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="cover">Cover</label>
                        <input type="file" class="form-control mb-3 @error('cover') is-invalid @enderror" name="cover" id="cover-input-file" value="{{ old('cover') }}">
                        <input type="text" name="cover_link" id="cover-link" class="form-control @error('cover_link') is-invalid @enderror" placeholder="Cover Link" value="{{ old('cover_link') }}">
                        <span class="form-text text-muted">fill in only one field</span>
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