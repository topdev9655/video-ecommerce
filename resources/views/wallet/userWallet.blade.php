@extends('layouts/main')

@section('title', 'user wallet')

@section('page-title', 'User Wallet')

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
        "order": [[ 0, "asc" ]]
      });
    });
  </script>
@endsection



@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">User Wallet</h3>
        </div>
        <div class="card-body">
            <table id="userTable" class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Wallet Balance</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($wallets as $wallet)
                  <script>
                    if ({{ $wallet->wallet ?? 0 }} > 0) {
                      fetch(`https://api.frankfurter.app/latest?amount={{ $wallet->wallet }}&from=USD&to=MYR`)
                        .then(res => res.json())
                        .then(json => $('#myr-wallet-{{ $wallet->id }}').text(`${json.rates.MYR} MYR`))
                    }
                  </script>
                  <tr>
                      <td>{{ $wallet->name }}</td>
                      <td>{{ $wallet->email }}</td>
                      <td>{{ $wallet->wallet ?? 0 }} USD <small id="myr-wallet-{{ $wallet->id }}"></small></td>
                  </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
      </div>
    </div>
</div>
@endsection