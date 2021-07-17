@section('head')
    @include('layouts.parts.head')
@show
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @section('navbar')
    @include('layouts.parts.navbar')
@show

  <!-- Main Sidebar Container -->
  @section('sidebar')
    @include('layouts.parts.sidebar')
@show

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0">@yield('page-title')</h1>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        @yield('content')
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @section('footer')
    @include('layouts.parts.footer')
@show
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


@section('script')
    @include('layouts.parts.script')
@show