<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | {{ config('app.name') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Nunito', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border: none;
            width: 400px; 
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
        }
        .btn-primary {
            background-color: #4a76a8;
            border-color: #4a76a8;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s, border-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #39596a;
            border-color: #39596a;
        }
        .form-control {
            border-radius: 0.25rem;
            border: 1px solid #ced4da;
            padding: 10px 15px;
            margin-bottom: 15px;
        }
        .invalid-feedback {
            color: #e3342f;
        }
        .alert-danger {
            padding: 10px;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .card-header {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
 
    <div class="card">
        <div class="card-header text-center">{{ __('Reset Your Password') }}</div>

        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session()->has('status'))
                <div>
                    {{session()->get('status')}}
                </div>
            @endif
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <div>
                    <input type="hidden" name="token" value="{{request()->token}}">
                    <input type="hidden" name="email" value="{{request()->email}}">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div>
                    <label for="password_confirmation" class="form-label">Repeat</label>
                    <input type="password" class="form-control" name="password_confirmation">
                    <input type="submit" value="Update Password" class="btn btn-primary w-100 mt-3">
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>

</body>
<script src="loginScript.js"></script>
</html>


