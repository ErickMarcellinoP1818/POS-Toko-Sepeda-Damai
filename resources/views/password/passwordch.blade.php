<!DOCTYPE html>
<html lang="en">
<head>
    <title>Program Toko - Nota</title>
    @include('ADMTemplate.head')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


</head>
<body id="page-top">
    <div id="wrapper">
        @include('ADMTemplate.left-sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('ADMTemplate.navbar')

                <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                            
                        @endif
                        <h3 class="text-center" style="">Change Password</h3>
                    </div>

                    <form class="card-body user" action="{{ route('user.changepassword') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="font-weight-bold">Password Lama</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="InputOldPassword" 
                                    placeholder="Masukkan Password Lama"
                                    value="{{ old('OldPassword') }}" name="OldPassword">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <a href="#" onclick="togglePassword('InputOldPassword', this); return false;">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                            @error('OldPassword')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="InputPassword" 
                                    placeholder="Masukkan Password Baru"
                                    value="{{ old('password') }}" name="password">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <a href="#" onclick="togglePassword('InputPassword', this); return false;">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Konfirmasi Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="InputPasswordNew" 
                                    placeholder="Konfirmasi Password Baru"
                                    value="{{ old('passwordNew') }}" name="passwordNew">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <a href="#" onclick="togglePassword('InputPasswordNew', this); return false;">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                            @error('passwordNew')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-success btn-block">Save</button>
                    </form>
                </div>
            </div>
            </div>

        </div>
    </div>
    @include('ADMTemplate.footer')

    @include('ADMTemplate.logoutModal')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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
        function togglePassword(inputId, el) {
            const input = document.getElementById(inputId);
            const icon = el.querySelector('i');

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>

    @include('ADMTemplate.script')
</body>
</html>
