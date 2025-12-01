<!DOCTYPE html>
<html lang="en">

<head>
    <title>Product</title>
    @include('template.header')
    <style>
        body {
            background-color: #f2f1ec;
        }

        .product-detail {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 100px;
            margin-bottom: 50px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .product-images {
            flex: 1 1 40%;
            max-width: 40%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .product-images img {
            width: 100%;
            border-radius: 10px;
            transition: transform 0.3s;
        }

        .product-images img:hover {
            transform: scale(1.05);
        }

        .product-info {
            flex: 1 1 55%;
            max-width: 55%;
        }

        .product-info h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            color: #333;
        }

        .product-info .price {
            font-size: 2em;
            color: #e74c3c;
            margin-bottom: 20px;
        }

        .product-info .quota,
        .product-info .stock,
        .product-info .isi {
            font-size: 1.3em;
            margin-bottom: 10px;
        }

        .product-info .description {
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .product-detail {
                flex-direction: column;
                gap: 0;
            }

            .product-images,
            .product-info {
                max-width: 100%;
            }

            .related-products .product {
                width: 48%;
                margin-right: 2%;
            }
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
    <div class="product-detail">
        <div class="product-images">
            <div class="mt-3">
                <button class="me-3" onclick="prevImage()"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                    </svg>
                </button>
            </div>
            <div class="card me-3">
                <div class="card-header">
                    <img id="mainImage" src="{{ asset('storage/' . $produk->varian->first()->gambar) }}" alt="Product Image" style="max-height: 300px; object-fit: contain;">
                </div>
                <div class="card-body justify-content-center text-center">
                        <h1 id="namaVarian">{{ $produk->varian->first()->nama_varian }}</h1>
                        <h2 id="stokVarian">Stok: {{ $produk->varian->first()->totalStok() }}</h2>
                        @if(auth()->check() && auth()->user()->jabatan !== 'non')
                        <form id="addToCartForm" method="GET" 
                             action="{{ route('addproduk.to.cart', ['id' => $produk->varian->first()->id]) }}">
                             <button type="submit" class="btn btn-secondary">Tambah ke keranjang</button>
                         </form>
                         @endif
                </div>
            </div>
    
        <div class="mt-3">
            <button class="ml-auto" onclick="nextImage()"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-right-square" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm4.5 5.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z"/>
                </svg>
            </button>
        </div>
        </div>

        <div class="product-info card">
            <div class="card-header">
                <h1>{{ $produk->nama }}</h1>
            </div>
            <div class="card-body">
                <div class="price">Rp. {{ number_format($produk->harga, 0, ',', '.') }},-</div>
                
                <hr class="divider">

                <p class="stock" style="font-size: larger;">Kategori: {{ $produk->kategori->nama ?? '-' }}</p>
                
                <p class="stock" style="font-size: larger;">Stok Produk: {{ $stock }}</p>
                <hr class="divider">

                <div class="description ">
                    <p style="font-size: larger;">
                        {{ $produk->deskripsi }}
                    </p>
                </div>
            </div>

        </div>
    </div>
    <!-- product end -->

    <!-- footer -->
    @include('template.foot')
    <!-- footer ends -->

    @include('template.script')
    <script>
    const imagePaths = [
        @foreach ($produk->varian as $v)
            "{{ asset('storage/' . $v->gambar) }}",
        @endforeach
    ];

    const nama = [
        @foreach ($produk->varian as $v)
            "{{ $v->nama_varian }}",
        @endforeach
    ]

    const stok = [
        @foreach ($produk->varian as $v)
            "{{ $v->totalStok() }}",
        @endforeach
    ];

    const id = [
        @foreach($produk->varian as $v)
            "{{ $v->id }}",
        @endforeach
    ]

    let currentIndex = 0;

    function updateImage() {
        const img = document.getElementById('mainImage');
        img.src = imagePaths[currentIndex];
    }

    
    function updateAddToCartLink() {
        const form = document.getElementById('addToCartForm');
        const idVarian = id[currentIndex];
        form.action = `/product/${idVarian}`;
    }


    function updateTitle(){
        const title = document.getElementById('namaVarian');
        title.textContent = nama[currentIndex];
    }
    function updateStok(){
        const stokDisplay = document.getElementById('stokVarian');
        stokDisplay.textContent = 'Stok: ' + stok[currentIndex];
    }

    function nextImage() {
        currentIndex = (currentIndex + 1) % imagePaths.length;
        updateImage();
        updateTitle();
        updateStok();
        updateAddToCartLink();
    }

    function prevImage() {
        currentIndex = (currentIndex - 1 + imagePaths.length) % imagePaths.length;
        updateImage();
        updateTitle();
        updateStok();
        updateAddToCartLink();
    }
</script>
</body>

</html>
