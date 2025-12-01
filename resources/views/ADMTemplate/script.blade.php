    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


 

    <!-- Sebelum </body> -->


    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>
    <script>
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>


    <!-- Page level plugins -->
    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const tanggalMulai = document.getElementById('filterDate');
        const tanggalSelesai = document.getElementById('filterDateDone');

        tanggalMulai.addEventListener('change', function () {
            tanggalSelesai.min = this.value;
            if (tanggalSelesai.value < this.value) {
                tanggalSelesai.value = this.value;
            }
        });
    });
</script>

<script>
        document.addEventListener('DOMContentLoaded', function () {
            const rows = document.querySelectorAll('.nota-row');
            const rowsPerPage = 10;
            let currentPage = 1;

            function showPage(page) {
                const start = (page - 1) * rowsPerPage;
                const end = start + rowsPerPage;
                const totalPages = Math.max(1, Math.ceil(rows.length / rowsPerPage));

                rows.forEach((row, index) => {
                    row.style.display = index >= start && index < end ? '' : 'none';
                });

                document.getElementById('pageInfo').innerText = `Halaman ${page} dari ${totalPages}`;
                document.getElementById('prevPage').disabled = page === 1;
                document.getElementById('nextPage').disabled = end >= rows.length;
            }

            document.getElementById('prevPage').addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    showPage(currentPage);
                }
            });

            document.getElementById('nextPage').addEventListener('click', () => {
                if ((currentPage * rowsPerPage) < rows.length) {
                    currentPage++;
                    showPage(currentPage);
                }
            });

            showPage(currentPage);
        });
    </script>
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
            document.getElementById("filterYear").addEventListener("change", function () {
                this.form.submit();
            });
        </script>
        
    

    
