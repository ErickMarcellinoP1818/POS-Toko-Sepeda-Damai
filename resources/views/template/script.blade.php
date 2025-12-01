<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/js/lightgallery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script src="{{ asset('homeScript.js') }}"></script>

<script>
    lightGallery(document.querySelector('.gallery .gallery-container'));
</script>
<script>
    const darkModeToggle = document.getElementById('darkModeToggle');
    const body = document.body;

    if (localStorage.getItem('dark-mode') === 'enabled') {
        body.classList.add('dark-mode');
    }

    darkModeToggle.addEventListener('click', () => {
        body.classList.toggle('dark-mode');

        if (body.classList.contains('dark-mode')) {
            localStorage.setItem('dark-mode', 'enabled');
        } else {
            localStorage.setItem('dark-mode', 'disabled');
        }
    });
</script>
<script src="loginScript.js"></script>
    <script>
        @if (session('alert'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('alert') }}",
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
        @endif

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
        @endif
        
    </script>
    <script>
        document.getElementById("cart-btn").addEventListener("click", function () {
            let cart = document.getElementById("shopping-cart");
            cart.style.display = (cart.style.display === "none" || cart.style.display === "") ? "block" : "none";
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".edit-cart-info").change(function(e) {
                e.preventDefault();
                var ele = $(this);
                $.ajax({
                    url: '{{ route('update.shopping.cart') }}',
                    method: "PATCH",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.closest(".cart-item").data("id"),
                        quantity: ele.closest(".cart-item").find(".quantity").val()
                    },
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            $(".delete-product").click(function(e) {
                e.preventDefault();
                var ele = $(this);

                if (confirm("Do you really want to delete?")) {
                    $.ajax({
                        url: '{{ route('delete.cart.product') }}',
                        method: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: ele.closest(".cart-item").data("id")
                        },
                        success: function(response) {
                            window.location.reload();
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>

