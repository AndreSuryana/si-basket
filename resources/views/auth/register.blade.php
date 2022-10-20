<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="Icon" href="{{ asset('assets/basketball-ball.png') }}">
    <title>SiBasket | Register</title>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-sm p-3 bg-body rounded">
            <h2 class="text-center mb-4">SiBasket</h2>
            @include('partials.alert')
            <form action="{{ route('postRegister') }}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="nama-depan" class="fw-bold">Nama Depan</label>
                            <input type="text" id="nama-depan" name="first_name" class="form-control mt-1" placeholder="Nama Depan">
                        </div>
                        <div class="col">
                            <label for="nama-belakang" class="fw-bold">Nama Belakang</label>
                            <input type="text" id="nama-belakang" name="last_name" class="form-control mt-1" placeholder="Nama Belakang">
                        </div>
                    </div>
                    <label for="nama-lengkap" class="fw-bold mt-3">Nama Lengkap</label>
                    <input type="text" id="nama-lengkap" name="full_name" class="form-control mt-1" placeholder="Nama Lengkap">
                    <label for="email" class="fw-bold mt-3">Email</label>
                    <input type="email" id="email" name="email" class="form-control mt-1" placeholder="youremail@email.com">
                    <label for="password" class="fw-bold mt-3">Password</label>
                    <input type="password" id="password" name="password" class="form-control mt-1" placeholder="Password">
                    <label for="konfirmasi-password" class="fw-bold mt-3">Konfirmasi Password</label>
                    <input type="password" id="konfirmasi-password" name="password_confirmation" class="form-control mt-1" placeholder="Konfirmasi Password">
                    <div class="d-grid gap-2 text-center">
                        <button class="btn btn-primary btn-lg mt-4" type="submit">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>