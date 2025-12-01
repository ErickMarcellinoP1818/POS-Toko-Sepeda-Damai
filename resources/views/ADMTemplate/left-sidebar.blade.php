<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: black;">

    <!-- Sidebar - Brand -->
    <a style="margin-top:10px ; "class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('images/damai.jpeg') }}" alt="Logo P3L" style="height: 50px; width: 50px; border-radius: 50%; background-color: white;">
        </div>
        <div class="sidebar-brand-text mx-3">Toko Sepeda Damai</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/') }}">
        <i class="bi bi-house-door-fill"></i> <span>Halaman Utama</span></a>
    </li>
    
    <hr class="sidebar-divider my-0">
    @if(Auth::check() && Auth::user()->jabatan == 'admin')
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i> <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
       Laporan
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport" aria-expanded="true" aria-controls="collapseReport">
            <i class="bi bi-receipt"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseReport" class="collapse" aria-labelledby="headingReport"
            data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <h6 class="collapse-header">Laporan:</h6>
                <a class="collapse-item" style="color:white" href="{{ url('/restock') }}"> <i class="bi bi-bag-fill"></i> Pembelian</a>
                <a class="collapse-item"  style="color:white" href="{{ url('/detilnota') }}"> <i class="bi bi-cash-stack"></i> Penjualan</a>
                <a class="collapse-item" style="color:white" href="{{ url('/labarugi') }}"> <i class="bi bi-card-list"></i> Laba Rugi</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Produk
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKelProd" aria-expanded="true" aria-controls="collapseKelProd">
            <i class="fas fa-fw fa-cog"></i>
            <span>Kelola Produk</span>
        </a>
        <div id="collapseKelProd" class="collapse" aria-labelledby="headingKelProd" data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item" style="color:white" href="{{ url('/produks') }}">
                     <i class="fas fa-fw fa-box"></i> Produk
                </a>
                <a class="collapse-item" style="color:white" href="{{ url('/kategori') }}">
                    <i class="fas fa-fw fa-cookie-bite"></i> Kategori
                </a>
                <a class="collapse-item" style="color:white" href="{{ url('/rincianbeli') }}">
                    <i class="bi bi-bag-fill"></i> Pembelian
                </a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/tempo') }}">
            <span>
                <i class="bi bi-journal-bookmark"></i> Pembelian Belum Lunas
            </span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/supplier') }}">
            <i><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 14 14"><path fill="currentColor" fill-rule="evenodd" d="M12.918 1.623a1.623 1.623 0 1 1-3.246 0a1.623 1.623 0 0 1 3.246 0m1.024 5.037a.75.75 0 0 1-.732.586H7.098a.75.75 0 1 1 0-1.5h1.596A2.706 2.706 0 0 1 14 6.493a.27.27 0 0 1-.058.167M1.359 3.324a1.811 1.811 0 1 0 3.622 0a1.811 1.811 0 0 0-3.622 0M0 9.019a3.17 3.17 0 1 1 6.34 0v.858a.5.5 0 0 1-.5.5h-.86l-.398 3.185a.5.5 0 0 1-.496.438H2.253a.5.5 0 0 1-.496-.438l-.399-3.185H.5a.5.5 0 0 1-.5-.5z" clip-rule="evenodd"/></svg></i>
            <span>Data Supplier</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/karyawan') }}">
            <i class="bi bi-people"></i> <span>Karyawan</span> 
        </a>
    </li>

    <hr class="sidebar-divider">
    @endif

    <div class="sidebar-heading mt-3">
        Pengaturan Profil
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProfil" aria-expanded="true" aria-controls="collapseProfil">
            <i class="bi bi-person-circle"></i>
            <span>Profil User</span>
        </a>
        <div id="collapseProfil" class="collapse" aria-labelledby="headingProfil"
            data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="nav-link" style="color:white" href="{{ url('/user/show') }}">
                    <i class="bi bi-person"></i> Profil
                </a>
                <a class="nav-link" style="color:white" href="{{ url('/chpw') }}">
                    <i class="bi bi-lock-fill"></i>
                    <span>Ganti Password</span></a>
            </div>
        </div>
    </li>


    <hr class="sidebar-divider d-none d-md-block">

    
    <div class="text-center d-none d-md-inline">
        <button  class="rounded-circle border-0" id="sidebarToggle" ></button>
    </div>


</ul>
