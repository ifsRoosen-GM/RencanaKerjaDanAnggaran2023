<aside class="main-sidebar sidebar-dark-primary elevation-1" style="background-color: #242424;">

  <!-- Brand Logo -->
  <a href="{{asset("/")}}" class="brand-link" style="border-right: 0.5px black; background-image: url('{{ asset('layout/dist/img/bg.svg') }}');filter: saturate(160%);">
    <img src="{{ asset("layout/dist/img/del.png") }}" alt="ITDel Logo" class="brand-image text-outline" style="opacity: 1;text-shadow: -2px -2px 0 black, 2px -2px 0 black, -2px 2px 0 black, 2px 2px 0 black;">
    <span class="brand-text font-weight-bolder d-flex flex-row text-outline" style="color: white; text-shadow: -0.5px -0.5px 0 black, 0.5px -0.5px 0 black, -0.5px 0.5px 0 black, 0.5px 0.5px 0 black; font-family: 'Source Sans Pro', sans-serif;">RKA - IT DEL 2023</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar" style="font-size:12.5px; font-family: 'Montserrat', sans-serif;">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item mt-2">
          <a href="/" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
            <i class="nav-icon fas fa fa-home"></i>
            <p><b>
              Dashboard</b>
            </p>
          </a>
        </li>

        @if (Auth::user()->user_id == 777)
            
{{--         
        <li class="nav-header mt-2 ml-2" style="color:white; font-size:15.5px; font-weight:bold;">ANGGARAN</li>
        <li class="nav-item mt-2">
          <a href="/workgroup" class="nav-link {{ Request::is('workgroup') ? 'active' : '' }}">
            <i class="fa-solid fa-people-group nav-icon"></i>
            <p>
              Add WorkGroup
            </p>
          </a>
        </li> --}}

        <li class="nav-item">
          <a href="/jp" class="nav-link {{ Request::is('jp') ? 'active' : '' }}">
            <i class="fa-solid fa-line-chart nav-icon"></i>
            <p>
              Mata Anggaran
            </p>
          </a>
        </li>


        <li class="nav-item">
          <a href="/satuan" class="nav-link {{ Request::is('satuan') ? 'active' : '' }}">
            
            <i class="fa-solid fa-sliders nav-icon"></i>
            <p>
              Satuan
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="/tahun" class="nav-link {{ Request::is('tahun') ? 'active' : '' }}">
            
            <i class="fa-regular fa-calendar nav-icon"></i>
            <p>
              Tahun Anggaran
            </p>
          </a>
        </li>

        

        @endif

        <br>
        @if (Auth::user()->user_id != 777)
        <li class="nav-header mt-3 ml-2" style="color:white; font-size:15.5px;font-weight:bold;">WORK PLAN</li>

        {{-- CONTROLLER ONLY --}}

        {{-- <li class="nav-item">
          <a href="/listJenisAnggaran" class="nav-link {{ Request::is('listJenisAnggaran') ? 'active' : '' }}">
            <i class="fa-sharp fa-solid fa-print nav-icon"></i>
            <p>List Pengajuan RKA</p>
          </a>
        </li> --}}
        {{-- CONTROLLER ONLY --}}

        

        <li class="nav-item">
          <a href="/program" class="nav-link {{ Request::is('RKA') ? 'active' : '' }}">
            <i class="fa-sharp fa-solid fa-clipboard-list nav-icon"></i>
            <p>
              Program
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="/program/create" class="nav-link {{ Request::is('pengajuan') ? 'active' : '' }}">
            <i class="nav-icon fa-solid fa-sack-dollar"></i>
            <p>Ajukan Program</p>
          </a>
        </li>
        @endif
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
