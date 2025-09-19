<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>
        @hasSection('title')
            @yield('title') | Cashbook
        @else
            Cashbook
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
                    Cashbook
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
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
