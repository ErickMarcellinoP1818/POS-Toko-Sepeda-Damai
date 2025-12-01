<!DOCTYPE html>
<html lang="en">
<head>
    <title>Program Toko - Profil</title>
    @include('ADMTemplate.head')
</head>
<body>
<div id="wrapper">
    @include('ADMTemplate.left-sidebar')

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            @include('ADMTemplate.navbar')

            <div class="container mt-4">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary">Profil Pengguna</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center" >
                            <form action="{{ route('user.updatefoto', $user->id) }}" method="POST" enctype="multipart/form-data" class="mb-2">
                                @csrf
                                @method('PUT')
                                <input type="file" name="foto" id="gambarInput" class="d-none" onchange="this.form.submit()">
                                <label for="gambarInput" style="cursor: pointer;">
                                    <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto Profil"
                                        class="rounded-circle mb-3" width="150" height="150"
                                        onerror="this.onerror=null;this.src='{{ asset('images/noPhoto.png') }}';">
                                </label>
                                <p class="text-muted" style="margin-top: -10px;">Klik gambar untuk ganti foto</p>
                            </form>
                            @if ($user->foto)
                                <form action="{{ route('user.deleteFoto', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-sm-3">
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Hapus Foto Profil
                                            </button>
                                        </div>
                                    </div>
                                </form>

                            @endif
                        </div>
                        
                        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="mb-2">
                            @csrf
                            @method('PUT')
                        <div class="form-group row mt-4">
                            <label for="username" class="col-sm-2 col-form-label">Username:</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="Name" placeholder="Username"
                                    value="{{ old('name', $user->name) }}" name="name">
                                @error('name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-4">
                            <label for="username" class="col-sm-2 col-form-label">Email:</label>

                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="email" placeholder="Email"
                                    value="{{ old('email', $user->email) }}" name="email" disabled>
                                @error('email')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row d-flex content-justify-center mt-4 form-group">
                            <div class="col col-sm-5 offset-md-2">
                                <button class="btn btn-success btn-block mt-4">Simpan</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('ADMTemplate.footer')
    </div>
</div>



@include('ADMTemplate.logoutModal')
@include('ADMTemplate.script')
</body>
</html>