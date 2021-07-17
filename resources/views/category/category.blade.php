@extends('layouts/main')

@section('title', 'categories')

@section('page-title', 'Categories')

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
      const table = $('#categoryTable').DataTable({
        "order": [[ 0, "asc" ]],
        "columnDefs": [
          {"targets": [2], "orderable": false}
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
            Movie Categories
            <a href="{{ route('category.create') }}" class="btn btn-sm btn-primary">Add new category</a>
          </h3>
        </div>
        <div class="card-body">
            <table id="categoryTable" class="table table-hover w-100">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($categories as $category)
                    <tr>
                      <td>{{ $category->title }}</td>
                      <td>{{ $category->description ?? '-' }}</td>
                      <td>
                        <div class="btn-group btn-group-sm">
                          <a href="{{ route('category.edit', $category->id) }}" class="btn btn-default" title="Edit">
                            <i class="fas fa-edit"></i>
                          </a>
                          <a href="#" class="btn btn-default" title="Delete" onclick="event.preventDefault();document.getElementById('del{{ $category->id }}-form').submit();">
                            <i class="fas fa-trash"></i>
                          </a>
                        </div>
                        <form id="del{{ $category->id }}-form" action="{{ route('category.destroy', $category->id) }}" method="POST" style="display: none;">
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