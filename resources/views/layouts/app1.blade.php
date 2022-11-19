<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <script>setTimeout(function() {
    $('#error').fadeOut('fast');
    }, 3000); // <-- time in milliseconds
    </script>

    @vite(['resources/js/app.js'])

</head>
<body>
<main>
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Twelfth navbar example">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample10" aria-controls="navbarsExample10" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample10">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Munkaidőnyilvántartó</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{URL('/leave')}}">Szabadságok</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{URL('/project')}}">Projektek</a>
                    </li>
                    @can('manager')
                    <li class="nav-item">
                        <a class="nav-link" href="{{URL('/manager')}}">Menedzser</a>
                    </li>
                    @endcan
                    @can('admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{URL('/admin')}}">Admin</a>
                        </li>
                    @endcan
                    <li>
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="mt-5">
        <div class="bg-light p-5 rounded">
            <div class="col-sm-8 mx-auto">



                @if ($errors->any())
                    <div id="error">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    </div>
                @endif


                @yield('content')
{{--                <h1>Navbar examples</h1>--}}
{{--                <p>This example is a quick exercise to illustrate how the navbar and its contents work. Some navbars extend the width of the viewport, others are confined within a <code>.container</code>. For positioning of navbars, checkout the <a href="/docs/5.0/examples/navbar-static/">top</a> and <a href="/docs/5.0/examples/navbar-fixed/">fixed top</a> examples.</p>--}}
{{--                <p>At the smallest breakpoint, the collapse plugin is used to hide the links and show a menu button to toggle the collapsed content.</p>--}}
{{--                <p>--}}
{{--                    <a class="btn btn-primary" href="/docs/5.0/components/navbar/" role="button">View navbar docs &raquo;</a>--}}
{{--                </p>--}}
            </div>
        </div>
    </div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</body>
</html>
