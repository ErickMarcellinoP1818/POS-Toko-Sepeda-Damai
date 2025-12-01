<header class="header">
    <img class= "logo"src="{{ asset('images/damai.jpeg') }}" alt="Logo P3L" style="height: 50px; width: 50px;">
    
    

    <nav class="navbar">
        <a href="{{ url('/#home') }}" class="nav-link">home</a>
        <a href="{{ url('/#about') }}" class="nav-link">Tentang Kami</a>
        <a href="{{ url('/#gallery') }}" class="nav-link">Galeri</a>
        <a href="/produkHome" class="nav-link">produk</a>
        @if (Auth::check() && Auth::user()->jabatan == 'admin')
            <a href="/dashboard" class="nav-link">Halaman Admin</a>
        @endif
    </nav>

    <div class="icons">

        @if (Auth::check() &&auth()->user()->jabatan !== 'non')
        @php
        $cart = session('cart', []);
        $belanjaan=0;
        @endphp
        @foreach ( $cart as $item)
            @php
            $belanjaan ++;
            @endphp
        @endforeach
            <div id="cart-btn" class="fas fa-shopping-cart"> <span class="cart-count">{{ $belanjaan }}</span></div>
            <div id="profile-btn" onclick="window.location.href='{{ url('/user/show', ) }}'" class="fas fa-user">
            </div>
        @endif
        @if (Auth::check())
            <div id="logout-btn" onclick="window.location.href='<?php echo route('actionLogout'); ?>'" class="fas fa-sign-out-alt">
            </div>
        @else
            <div id="login-btn" onclick="window.location.href='{{ url('login') }}'" class="fas fa-sign-in-alt">
            </div>
        @endif
        <div id="menu-btn" class="fas fa-bars"></div>
    </div>
</header>
