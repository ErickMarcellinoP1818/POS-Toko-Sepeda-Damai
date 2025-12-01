<div class="cart-items-container">
    @php $total = 0 @endphp
    <div id="close-form" class="fas fa-times"></div>

    @if (session('cart'))
        <h3 class="title">Checkout</h3>

        @foreach (session('cart') as $id => $details)
        
            @php $total += $details['harga'] * $details['jumlah'] @endphp
            <div class="cart-item" data-id="{{ $id }}">
                <a href="#" class="delete-product"><i class="fas fa-times"></i></a>
                <img src="{{ asset('storage/' . $details['gambar']) }}" alt="Product">
                <div class="content">
                    <h3>{{ $details['nama'] }} {{ $details['varian'] }}</h3>
                    <div class="harga fs-4 fw-bold mb-2">Rp.{{ number_format($details['harga'], 0, ',', '.') }}/-</div>
                    <input type="number" class="quantity form-control edit-cart-info" min="1" value="{{$details['jumlah']}}">
                </div>
            </div>
        @endforeach

        <div class="total fs-3 fw-bold mt-3">Total: Rp.{{ number_format($total, 0, ',', '.') }}/-</div>
        <a href="{{ route('pesanan.create') }}" class="btn btn-success btn-lg mt-3">Checkout</a>
    @else
        <h3 class="title">Your cart is empty</h3>
    @endif
</div>

    
    @include('template.script')
