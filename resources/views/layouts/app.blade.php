<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>
        @hasSection('title')
            @yield('title') | Kassenbuch
        @else
            Kassenbuch
        @endif
    </title>

    <!-- Bootstrap CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body>
    <header class="">
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    📖 Kassenbuch
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}"
                                    href="{{ route('register') }}">
                                    Registrierung
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}"
                                    href="{{ route('login') }}">
                                    Login
                                </a>
                            </li>
                        @endguest
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center pb-1"
                                        style="width: 30px; height: 30px;">
                                        <i class="bi bi-person"></i>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li class="nav-item">
                                        <span class="dropdown-item-text">{{ Auth::user()->email }}</span>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="#">Profile</a>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

    </header>

    <main class="container">
        @yield('content')
    </main>

</body>

</html>
