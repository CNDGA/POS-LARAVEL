<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">


    @if (Auth::check() && Auth::user()->level_id == 3)
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{route('reports.stok')}}" target="">
        <i class="bi bi-grid"></i>
        <span>Stock Barang</span>
      </a>
    </li>

    @endif


    @if (Auth::check() && Auth::user()->level_id == 1)
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{route('reports.popular-products')}}" target="">
        <i class="bi bi-grid"></i>
        <span>Top Products</span>
      </a>
    </li>

    @endif


    <!-- End Dashboard Nav -->
    @if (Auth::check() && Auth::user()->level_id == 1)
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span>Master Data</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="/categories">
            <i class="bi bi-circle"></i><span>Category</span>
          </a>
        </li>

        <li>
          <a href="/users">
            <i class="bi bi-circle"></i><span>User</span>
          </a>
        </li>

        <li>
          <a href="/product">
            <i class="bi bi-circle"></i><span>Produk</span>
          </a>
        </li>

      </ul>
    </li><!-- End Components Nav -->

        @endif

        @if (Auth::check() && (Auth::user()->level_id == 1 || Auth::user()->level_id == 2))
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Pos Manage</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{route('pos.create')}}">
            <i class="bi bi-circle"></i><span>POS</span>
          </a>
        </li>
        <li>
          <a href="{{route('pos.index')}}">
            <i class="bi bi-circle"></i><span>Pos Sale</span>
          </a>
        </li>
       
      </ul>
    </li><!-- End Forms Nav -->
  @endif

    {{-- <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="tables-general.html">
            <i class="bi bi-circle"></i><span>General Tables</span>
          </a>
        </li>
        <li>
          <a href="tables-data.html">
            <i class="bi bi-circle"></i><span>Data Tables</span>
          </a>
        </li>
      </ul>
    </li> --}}
    <!-- End Tables Nav -->

    {{-- <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-bar-chart"></i><span>Charts</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="charts-chartjs.html">
            <i class="bi bi-circle"></i><span>Chart.js</span>
          </a>
        </li>
        <li>
          <a href="charts-apexcharts.html">
            <i class="bi bi-circle"></i><span>ApexCharts</span>
          </a>
        </li>
        <li>
          <a href="charts-echarts.html">
            <i class="bi bi-circle"></i><span>ECharts</span>
          </a>
        </li>
      </ul>
    </li> --}}
    
    <!-- End Charts Nav -->

    {{-- <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gem"></i><span>Icons</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="icons-bootstrap.html">
            <i class="bi bi-circle"></i><span>Bootstrap Icons</span>
          </a>
        </li>
        <li>
          <a href="icons-remix.html">
            <i class="bi bi-circle"></i><span>Remix Icons</span>
          </a>
        </li>
        <li>
          <a href="icons-boxicons.html">
            <i class="bi bi-circle"></i><span>Boxicons</span>
          </a>
        </li>
      </ul>
    </li> --}}
    
    <!-- End Icons Nav -->
    @if (Auth::check() && Auth::user()->level_id == 1)
    <li class="nav-heading">Roles</li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{route('levels.index')}}">
        <i class="bi bi-person"></i>
        <span>Levels</span>
      </a>
    </li><!-- End Profile Page Nav -->
    @endif

    {{-- <li class="nav-item">
      <a class="nav-link collapsed" href="pages-faq.html">
        <i class="bi bi-question-circle"></i>
        <span>F.A.Q</span>
      </a>
    </li> --}}
    
    <!-- End F.A.Q Page Nav -->

    {{-- <li class="nav-item">
      <a class="nav-link collapsed" href="pages-contact.html">
        <i class="bi bi-envelope"></i>
        <span>Contact</span>
      </a>
    </li> --}}
    
    <!-- End Contact Page Nav -->

    {{-- <li class="nav-item">
      <a class="nav-link collapsed" href="pages-register.html">
        <i class="bi bi-card-list"></i>
        <span>Register</span>
      </a>
    </li>
     --}}
    <!-- End Register Page Nav -->

    {{-- <li class="nav-item">
      <a class="nav-link collapsed" href="pages-login.html">
        <i class="bi bi-box-arrow-in-right"></i>
        <span>Login</span>
      </a>
    </li> --}}
    
    <!-- End Login Page Nav -->

    {{-- <li class="nav-item">
      <a class="nav-link collapsed" href="pages-error-404.html">
        <i class="bi bi-dash-circle"></i>
        <span>Error 404</span>
      </a>
    </li> --}}
    
    <!-- End Error 404 Page Nav -->
    @if (Auth::check() && Auth::user()->level_id == 3)
    <li class="nav-item">
      <a class="nav-link " href="{{route('reports.index')}}">
        <i class="bi bi-file-earmark"></i>
        <span>Report</span>
      </a>
    </li>
    @endif
    <!-- End Blank Page Nav -->

  </ul>

</aside><!-- End Sidebar-->