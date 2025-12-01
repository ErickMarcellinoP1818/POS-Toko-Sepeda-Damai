<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
     <div class="row align-items-center">
            <form method="GET" action="{{ url()->current() }}" class="form-inline d-flex align-items-end">
                @if(Route::is('dashboard.index'))
                <div class="col-md ms-2 text-center">
                    <select id="filterYear" name="filterYear" class="form-control">
                        @for ($year = 2020; $year <= now()->format('Y'); $year++)
                            <option value="{{ $year }}" {{ request('filterYear', now()->format('Y')) == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endfor
                    </select>
                @endif
                @if(!Route::is('dashboard.index'))
                <div class="input-group me-2" style="margin-left:5px;">
                    <input type="text" name="search" class="form-control bg-light border-0 small"
                        placeholder="Search for..." value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
                @endif

                @php
                $usere  = Auth::user();
                @endphp
                @if(Route::is('detilnota.index') || Route::is('restock.index') || Route::is('labarugi'))
                <div class="col-md ms-2 text-center">
                    <label class="row align-item-center d-flex flex-column text-center" for="filterDate" class="form-label mb-0 me-2">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="filterDate" name="filterDate"
                        value="{{ request('filterDate') ?? now()->format('Y-m-d') }}"
                        max="{{ now()->format('Y-m-d') }}">
                </div>
                <div class="col-md ms-2 text-center">
                    <label class="row align-item-center d-flex flex-column text-center" for="filterDate" class="form-label mb-0 me-2">Tanggal Selesai</label>
                    <input type="date" class="form-control" id="filterDateDone" name="filterDateDone"
                        value="{{ request('filterDateDone') ?? now()->format('Y-m-d') }}" max="{{ now()->format('Y-m-d') }}">
                </div>
                @endif
            </form>
        </div>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                            aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ $usere->name }}</span>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('user.show', Auth::user()->id) }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>
