<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        rel="stylesheet">

    <link rel="stylesheet" href="homeStyle.css">
    @include('template.script')
</head>
<!-- Custom CSS -->


<style>
    body {
        padding-top: 50px;
        background: #f2f1ec;
    }

    .card {
        margin-top: 20px;
    }

    .card-header {
        background-color: #783b31;
        color: #fff;
        text-align: center;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .btn-primary {
        background-color: #c98d83;
        border-color: #c98d83;
        margin-top: 10px;
    }
</style>

<body>
<a href='home' class="back-button btn btn-primary">Back</a>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>User Profile</h3>
                    </div>
                    <form class="card-body user" action="{{ route('user.update1', $user->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="username" class="col-sm-3 col-form-label">Username:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="Name" placeholder="Username"
                                    value="{{ old('name', $user->name) }}" name="name">
                                @error('name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-3 col-form-label">Email :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="Email" placeholder="Email"
                                    value="{{ old('email', $user->email) }}" name="email" disabled>
                                @error('email')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    
    @include('template.script');
</body>

</html>
