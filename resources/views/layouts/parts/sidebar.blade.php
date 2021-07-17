<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light text-uppercase">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assets/img/default.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ route('user.show', Auth::user()->id) }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link @if(Request()->segment(1) == 'dashboard') active @endif">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('movie.index') }}" class="nav-link @if(Request()->segment(1) == 'movie') active @endif">
            <i class="fas fa-film nav-icon"></i>
            <p>Movie</p>
          </a>
        </li>
        <li class="nav-item @if(Request()->segment(1) == 'user' || Request()->segment(1) == 'wallet') menu-open @endif">
          <a href="#" class="nav-link  @if(Request()->segment(1) == 'user' || Request()->segment(1) == 'wallet') active @endif">
            <i class="nav-icon fas fa-users"></i>
            <p>
              User
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('user.index') }}" class="nav-link  @if(Request()->segment(1) == 'user') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>User List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('wallet.index') }}" class="nav-link @if(Request()->segment(1) == 'wallet') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>User wallets</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item @if(Request()->segment(1) == 'category' || Request()->segment(1) == 'genre' || Request()->segment(1) == 'language') menu-open @endif">
          <a href="#" class="nav-link  @if(Request()->segment(1) == 'category' || Request()->segment(1) == 'genre' || Request()->segment(1) == 'language') active @endif">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Reference
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('category.index') }}" class="nav-link  @if(Request()->segment(1) == 'category') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Category</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('genre.index') }}" class="nav-link @if(Request()->segment(1) == 'genre') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Genre</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('language.index') }}" class="nav-link @if(Request()->segment(1) == 'language') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Language</p>
              </a>
            </li>
          </ul>
        </li>
        {{-- <li class="nav-item">
          <a href="{{ route('video') }}" class="nav-link @if(Request()->segment(1) == 'video') active @endif">
              <i class="nav-icon far fa-circle nav-icon"></i>
              <p>
              Demo for Video
              </p>
          </a>
        </li> --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>