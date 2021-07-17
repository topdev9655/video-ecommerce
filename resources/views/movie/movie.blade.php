@extends('layouts/main')

@section('title', 'movie')

@section('page-title', 'Movie')

@section('page-style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ url('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('page-script')
<!-- DataTables  & Plugins -->
<script src="{{ url('assets/plugins/datatables/jquery.dataTables.min.js')  }}"></script>
<script src="{{ url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')  }}"></script>
<script src="{{ url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')  }}"></script>
<script src="{{ url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')  }}"></script>
<script src="{{ url('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')  }}"></script>
<script src="{{ url('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')  }}"></script>
<script src="{{ url('assets/plugins/jszip/jszip.min.js')  }}"></script>
<script src="{{ url('assets/plugins/pdfmake/pdfmake.min.js')  }}"></script>
<script src="{{ url('assets/plugins/pdfmake/vfs_fonts.js')  }}"></script>
<script src="{{ url('assets/plugins/datatables-buttons/js/buttons.html5.min.js')  }}"></script>
<script src="{{ url('assets/plugins/datatables-buttons/js/buttons.print.min.js')  }}"></script>
<script src="{{ url('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')  }}"></script>
<script>
    $(function () {
      const table = $('#movieTable').DataTable({
        "order": [[ 3, "desc" ]],
        "columnDefs": [
          {"targets": [0, 5, 6, 7], "orderable": false}
        ]
      });
    });
  </script>
@endsection



@section('content')
<div class="row">
    <div class="col-12">
      @if (session('message'))
          <div class="alert alert-success alert-dismissible">
              {{ session('message') }}
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          </div>
      @endif
      <div class="card">
        <div class="card-header">
          <h3 class="card-title d-flex justify-content-between w-100">
            Movie list
            <a href="{{ route('movie.create') }}" class="btn btn-sm btn-primary">Add new movie</a>
          </h3>
        </div>
        <div class="card-body">
            <table id="movieTable" class="table table-hover w-100">
                <thead>
                    <tr>
                        <th>Poster</th>
                        <th>Title</th>
                        <th>Year</th>
                        <th>Release Date</th>
                        <th>Duration</th>
                        <th>Category</th>
                        <th>Genre</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($movies as $movie)
                    <tr>
                      <td>
                        @if ($movie->poster || $movie->poster_link)  
                          <img src="{{ $movie->poster ? asset('storage/'.$movie->poster) : $movie->poster_link }}" alt="movie poster" width="100" class="bg-light">
                        @else
                          <div class="bg-light d-flex align-items-center text-center" style="width: 100px; height: 150px;"><small>no poster uploaded</small></div>
                        @endif
                      </td>
                      <td>{{ $movie->title }}</td>
                      <td>{{ $movie->year }}</td>
                      <td>{{ $movie->release_date }}</td>
                      <td>{{ $movie->duration }}</td>
                      <td>
                        @foreach ($categories as $category)
                          @if (in_array($category->id, explode(',', $movie->category)))
                            <span class="badge badge-success">{{ $category->title }}</span>
                          @endif
                        @endforeach
                      </td>
                      <td>
                        @foreach ($genres as $genre)
                          @if (in_array($genre->id, explode(',', $movie->genres)))
                            <span class="badge badge-dark">{{ $genre->title }}</span>
                          @endif
                        @endforeach
                      </td>
                      <td>
                        <div class="btn-group btn-group-sm">
                          <a href="{{ route('movie.show', $movie->id) }}" class="btn btn-default" title="Detail">
                            <i class="fas fa-ellipsis-h"></i>
                          </a>
                          <a href="{{ route('movie.edit', $movie->id) }}" class="btn btn-default" title="Edit">
                            <i class="fas fa-edit"></i>
                          </a>
                          <a href="#" class="btn btn-default" title="Delete" onclick="event.preventDefault();document.getElementById('del{{ $movie->id }}-form').submit();">
                            <i class="fas fa-trash"></i>
                          </a>
                        </div>
                        <form id="del{{ $movie->id }}-form" action="{{ route('movie.destroy', $movie->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('delete')
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
      </div>
    </div>
</div>
@endsection