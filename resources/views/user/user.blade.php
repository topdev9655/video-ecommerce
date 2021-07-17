@extends('layouts/main')

@section('title', 'user')

@section('page-title', 'User')

@section('page-style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('page-script')
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js')  }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')  }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')  }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')  }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')  }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')  }}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js')  }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js')  }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js')  }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')  }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')  }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')  }}"></script>
<script>
    $(function () {
      $('#userTable').DataTable({
        "order": [[ 0, "asc" ]],
        "columnDefs": [
          {"targets": [3], "orderable": false}
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
            User list
            <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">Add new user</a>
          </h3>
        </div>
        <div class="card-body">
            <table id="userTable" class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        {{-- <th>Wallet Balance</th> --}}
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    {{-- <script>
                      if ({{ $user->wallet ?? 0 }} > 0) {
                        fetch(`https://api.frankfurter.app/latest?amount={{ $user->wallet }}&from=USD&to=MYR`)
                          .then(res => res.json())
                          .then(json => $('#myr-{{ $user->id }}').text(`${json.rates.MYR} MYR`))
                      }
                    </script> --}}
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                          @if ($user->is_admin)
                              <span class="badge badge-info">administrator</span>
                          @else
                            <span class="badge badge-dark">user</span>
                          @endif
                        </td>
                        {{-- <td>{{ $user->wallet ?? 0 }} USD <small id="myr-{{ $user->id }}"></small></td> --}}
                        <td>
                          <div class="btn-group btn-group-sm">
                            <a href="{{ route('user.show', $user->id) }}" class="btn btn-default" title="Detail">
                              <i class="fas fa-ellipsis-h"></i>
                            </a>
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-default" title="Edit">
                              <i class="fas fa-edit"></i>
                            </a>
                            @if ($user->username != 'admin')
                            <a href="#" class="btn btn-default" title="Delete" onclick="event.preventDefault();document.getElementById('del{{ $user->id }}-form').submit();">
                              <i class="fas fa-trash"></i>
                            </a>
                            @endif
                          </div>
                          @if ($user->username != 'admin')
                          <form id="del{{ $user->id }}-form" action="{{ route('user.destroy', $user->id) }}" method="POST" style="display: none;">
                              @csrf
                              @method('delete')
                          </form>
                          @endif
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