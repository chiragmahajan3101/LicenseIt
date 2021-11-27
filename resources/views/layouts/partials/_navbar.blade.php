<nav class="navbar navbar-expand-md navbar-light sticky-top bg-white">
    <div class="container">
        <a class="navbar-brand text-hblack" href="{{ url('/') }}" style="font-family: 'Rubik', sans-serif;">
            <img src="images/logo2.svg" width="70em"> <span class="text-orange">L</span>icense<span class="text-orange">I</span>t
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                @auth
                <a href="" class="nav-link text-muted font-weight-bold">Dashboard</a>
                @endauth
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link text-muted font-weight-bold" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            {{-- <a class="btn btn-orange" href="{{ route('register') }}">{{ __('Register') }}</a> --}}
                            <a class="btn btn-orange" href="">Welcome</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white font-weight-bold btn btn-hblack" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-hblack" href="{{ route('logout') }}"
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
