<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="Icon" href="{{ asset('assets/basketball-ball.png') }}">
    <title>SiBasket | {{ $title }}</title>
</head>

<body>
    <div class="d-flex flex-row">
        <!-- Sidebar -->
        <div class="d-flex flex-row ">
            <div class="p-4 bg-primary" style="width: 280px; min-height: 100vh;">
                <div class="d-flex flex-row px-2">
                    <a class="navbar-brand" href="{{ route('dashboard') }}">
                        <img src="{{ asset('assets/basketball-ball.png') }}" alt="Logo" height="40"
                            class="d-inline"></a>
                    <h2 class="d-inline ms-2 text-white">SiBasket</h2>
                </div>
                <ul class="nav nav-pills flex-column pt-4 mb-auto">
                    <li class="mb-1">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            <i class="bi bi-grid text-white me-1"></i>
                            <span class="text-white">Dashboard</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('profile') }}" class="nav-link">
                            <i class="bi bi-person text-white me-1"></i>
                            <span class="text-white">Profile</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <button class="nav-link" data-bs-toggle="collapse" data-bs-target="#referee-menu"
                            aria-expanded="false">
                            <i class="bi bi-gear text-white me-1"></i>
                            <span class="text-white">Menu Wasit <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                              </svg></span>
                        </button>
                        <div class="{{ Request::segment(1) == 'referee' ? 'collapsed' : 'collapse' }}"
                            id="referee-menu">
                            <ul class="btn-toggle-nav list-unstyled pt-2 ps-4 small">
                                <li><a href="{{ route('referee.data') }}" class="nav-link text-white">
                                        <i class="bi bi-pen me-1"></i>
                                        Formulir Data</a></li>
                                <li><a href="{{ route('referee.event') }}" class="nav-link text-white">
                                        <i class="bi bi-pen me-1"></i>
                                        Event</a></li>
                                <li><a href="{{ route('referee.license') }}" class="nav-link text-white">
                                        <i class="bi bi-pen me-1"></i>
                                        Lisensi</a></li>
                            </ul>
                        </div>
                    </li>
                    <hr class="text-white">
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link">
                                <i class="bi bi-box-arrow-right text-white"></i>
                                <span class="text-white">Sign Out</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Main -->
        <div class="container-fluid mt-3">
            @yield('main')
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js' integrity='sha512-CX7sDOp7UTAq+i1FYIlf9Uo27x4os+kGeoT7rgwvY+4dmjqV0IuE/Bl5hVsjnQPQiTOhAX1O2r2j5bjsFBvv/A==' crossorigin='anonymous'></script>
    @yield('js-body')
</body>

</html>
