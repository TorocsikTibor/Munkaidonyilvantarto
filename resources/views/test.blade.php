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

    @vite(['resources/js/app.js'])

</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
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

    <main class="py-4">
        @yield('content')
    </main>
</div>
<h1>Szabadság kalkulátor</h1>
<p>Alapszabadság :20</p>
<div>
    <form action="{{ route('leave') }}" method="post" >
        @csrf
        <label class="input-group-text">Típus:</label>
        <select name="type" id="type">
            <option value=1 >Fizetett szabadság</option>
            <option value=2 >Betegszabadság</option>
        </select>

        <label class="input-group-text">Kezdet:</label>
        <input type="date" name="start" />
        <label class="input-group-text">Vég:</label>
        <input type="date" name="end" />
        <label class="input-group-text">Szoveg:</label>
        <textarea  id="desc" name="desc"></textarea>
        <input type="submit" class="btn btn-success btn-kuldes" name="action" value="Mentés">
        <input type="submit" class="btn btn-success btn-kuldes" name="action" value="Draft">
    </form>

    <table>
        <tr>
            <th>Név</th>
            <th>Kezdet</th>
            <th>Vég</th>
            <th>Leírás</th>
            <th>Státusz</th>
        </tr>
        <tr>
            @if($leave)
                @foreach($leave as $leaves)
                    <td>{{$leaves->Users->name}}</td>
                    <td>{{$leaves->start}}</td>
                    <td>{{$leaves->end}}</td>
                    <td>{{$leaves->desc}}</td>
                    <td>{{$leaves->status}}</td>
                @endforeach
            @endif
        </tr>
    </table>

</div>

</body>
</html>
