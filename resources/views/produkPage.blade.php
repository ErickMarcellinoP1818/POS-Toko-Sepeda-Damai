<!DOCTYPE html>
<html lang="en">

<head>
    <title>Product</title>
    @include('template.header')
    <style>
        .product {
            padding: 20px;
        }
        .box {
            max-width: 500px; 
            margin: 10px;
            transition: all 0.3s ease;
        }

        .box:hover {
            transform: translateY(-10px);
        }

        .box img {
            width: 100%;
            object-fit: cover;
        }

        .box .content {
            padding: 15px;
            text-align: center;
        }

        .box .content h3 {
            margin: 10px 0;
        }

        .box .content .price {
            color: #e74c3c;
            font-weight: bold;
        }
        .empty-state {
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin: 20px auto;
            max-width: 500px;
        }

        .empty-icon {
            opacity: 0.6;
        }
            .form-control::placeholder {
            font-size: 14px;
            color: #888;
        }
        </style>
</head>

<body>

    <!-- header -->
    @include('template.navbar')
    <!-- header end -->

    <!-- shopping cart -->
    @include('template.shoppingCart')
    <!-- shopping cart end-->

    <!-- product -->
    <section class="product" id="product">
        @if($laris)
        <div style="margin-top: 90px;"></div>
        <h1 class="heading">produk <span>paling</span> laris</h1>
        @endif
        <div class="box-container">
            <div class="box-container">
              @foreach ($laris as $item)
              <div class="box">
                <a href="{{ route('produkHome.show', $item->id_produk) }}" class="text-decoration-none">
                    @include('partials.productBoxLaku', ['item' => $item->produk, 'laku' => $item->laku])
                </a>
              </div>
              @endforeach
            </div>
        </div>
    </section>
    <section class="product" id="produk">
        <div class="row align-items-center mt-5">


    <!-- Left - Heading -->
    <div class="col-md-4">
        <h1 class="heading mb-0">produk <span>kami</span></h1>
    </div>
    
    <!-- Middle - Category Dropdown -->
   <div class="col-md-4 text-center">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" 
                    id="categoryDropdown" data-toggle="dropdown" 
                    aria-haspopup="true" aria-expanded="false">
                Pilih Kategori
            </button>
            <div class="dropdown-menu" aria-labelledby="categoryDropdown">
                <a class="dropdown-item fs-3" href="{{ url()->current() }}">Semua Kategori</a>
                @foreach ($kategori as $item)
                    <a class="dropdown-item fs-3" href="{{ url()->current() }}?category={{ $item->id }}">
                        {{ $item->nama }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    
    <!-- Right - Search -->
    <div class="col-md-4 text-end">
        <form method="GET" action="{{ url('/produkHome#produk') }}" class="form-inline float-end">
            <div class="input-group" style="width: 300px;">
                <input type="text" 
                name="search" 
                class="form-control bg-light border-0 small" 
                placeholder="Cari..." 
                style="font-size: 16px;"
                value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" style="padding: 0 15px;">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
        <div class="box-container">
            @forelse ($produk as $item)
                    <div class="box">
                            <a href="{{ route('produkHome.show', $item->id) }}" class="text-decoration-none">
                            @include('partials.productBox', ['item' => $item])
                            </a>
                    </div>
            @empty
                <div class="empty-state text-center py-5 w-100">
                    <div class="empty-icon mb-3">
                        <i class="fas fa-box-open fa-4x text-muted"></i>
                    </div>
                    <h4 class="text-muted">Tidak ada produk ditemukan</h4>
                    <p class="text-muted">Silakan coba kata kunci lain atau kategori berbeda</p>
                </div>
            @endforelse
        </div>
        
    </section>
    <!-- product end -->

    <!-- footer -->
    @include('template.foot')
    <!-- footer ends -->

    @include('template.script')
    @include('ADMTemplate.script')
</body>

</html>
