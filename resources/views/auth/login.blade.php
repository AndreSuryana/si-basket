<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="Icon" href="{{ asset('assets/basketball-ball.png') }}">
    <title>SiBasket | Login</title>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-sm p-3 bg-body rounded">
            <h2 class="text-center mb-4">SiBasket</h2>
            @include('partials.alert')
            <form action="{{ route('postLogin') }}" method="POST">
                <div class="form-group">
                    @csrf
                    <label for="email" class="fw-bold">Email</label>
                    <input type="email" id="email" name="email" class="form-control mt-1" placeholder="youremail@email.com">
                    <label for="password" class="fw-bold mt-3">Password</label>
                    <input type="password" id="password" name="password" class="form-control mt-1" placeholder="Password">
                    <div class="d-grid gap-2 text-center">
                        <button class="btn btn-primary btn-lg mt-4" type="submit">Login</button>
                    </div>
                    <p class="mt-4 text-center">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>