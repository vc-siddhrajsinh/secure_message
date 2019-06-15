<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @stack('before-styles')
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet.css')}}">
    @stack('after-styles')
</head>
<body>
    <div id="app">
        <header class="main-header">
            <a class="logo" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <nav class="navbar-custom-menu">
                <ul class="">
                    <!-- Authentication Links -->
                    @guest
                        <li >
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li >
                            <a class="nav-link" href="{{ route('frontend.guest.login') }}">{{ __('Guest Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li >
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else

                    <li class="user-name-li">
                        <p class="user-name"  ><i class="fa fa-user"></i>{{ Auth::user()->name }}</p>
                    </li>
                    <li>
                        <a class="logout-btn" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            <i class="fa fa-power-off"></i>
                            <!-- {{ __('Logout') }} -->
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @endguest
                </ul>
            </nav>            
        </header>  
        <main class="">
            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    @stack('before-scripts')
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}

    <script src="{{ asset('js/jquery.min.js') }}" ></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}" ></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" ></script>
    @stack('after-scripts')

</body>
</html>
