<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        .hero {
            background: url('https://via.placeholder.com/1920x600') no-repeat center center/cover;
            height: 60vh;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .card:hover {
            transform: scale(1.03);
            transition: transform 0.3s ease;
        }

        .nav-link.active {
            background-color: #0d6efd;
            color: white !important;
            border-radius: 5px;
            padding: 5px 10px;
        }

        footer {
            background: #333;
            color: #fff;
            padding: 20px 0;
        }

        footer a {
            color: #fff;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div id="app">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ url('/') }}">
                    <img src="{{ asset('image/kowara.png') }}" alt="KOWARA Logo" width="70" class="me-2">
                    KOWARA
                </a>                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('daftar/artikel') ? 'active' : '' }}" href="{{ route('articles.list') }}">Artikel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="{{ route('about') }}">Tentang Kami</a>
                        </li>                        
                    </ul>
                </div>
                <!-- Tombol Login -->
                @guest
                <a class="btn btn-outline-dark ms-3" href="{{ route('login') }}">Login</a>
                @else
                <a class="btn btn-outline-danger ms-3" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                @endguest

            </div>
        </nav>

        <!-- Main Content -->
        <main class="py-4">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="text-center py-4 bg-dark">
            <div class="container">
                <p>&copy; 2025 KOWARA. All Rights Reserved.</p>
                <p>
                    <a href="#">Kebijakan Privasi</a> | 
                    <a href="#">Syarat dan Ketentuan</a>
                </p>
                <div class="mt-3">
                    <a href="https://www.instagram.com/kowarakebumen/?hl=id" target="_blank" class="mx-2">
                        <img src="{{ asset('image/instagram.png') }}" alt="Instagram" width="30">
                    </a>
                    <a href="https://web.facebook.com/profile.php?id=61550277861874" target="_blank" class="mx-2">
                        <img src="{{ asset('image/facebook.png') }}" alt="Facebook" width="30">
                    </a>
                    <a href="https://wa.me/6281906836000" target="_blank" class="mx-2">
                        <img src="{{ asset('image/whatsapp.png') }}" alt="WhatsApp" width="30">
                    </a>
                    <a href="https://youtube.com/@kowaratugubuayankebumen5229?si=uVZQ-ur7ItzSU_IO" target="_blank" class="mx-2">
                        <img src="{{ asset('image/youtube.png') }}" alt="Youtube" width="30">
                    </a>
                </div>
            </div>
        </footer>        
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>