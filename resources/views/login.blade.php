<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="loginStyle.css">
    <title>Program Toko</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <form method="post" action="{{ route('actionRegister') }}">
                @csrf
                <h1>Buat Akun</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <span>Gunakan akun email anda untuk pendaftaran</span>
                <input class="form-control" type="text" name="name" placeholder="Nama" required>
                <input class="form-control" type="email" name="email" placeholder="Email" required>
                <input class="form-control" type="password" name="password" placeholder="Password" required>
                <button type="submit">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <form method="post" action="{{ route('actionLogin') }}">
                @csrf
                @if (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif
                <h1>Sign In</h1>
                <span>gunakan email dan password anda untuk masuk</span>
                <input class="form-control" type="text" name="email" placeholder="Email" required>
                <input class="form-control" type="password" name="password" placeholder="Password" required>
                <a href="/forgot-password">Lupa Password? Silakan Tekan</a>
                <button type="submit">Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Selamat Datang!</h1>
                    <p>Isi semua form yang tersedia untuk dapat membuat sebuah akun</p>
                    <button class="hidden" id="login">Masuk</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Belum Punya Akun Kasir?</h1>
                    <p>Lakukan Register untuk Aktifkan Akun Kasir Anda</p>
                    <button class="hidden" id="register">Register</button>
                </div>
            </div>
        </div>
    </div>

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
</body>

</html>
