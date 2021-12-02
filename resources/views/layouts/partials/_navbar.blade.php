<nav class="navbar navbar-expand-md navbar-light sticky-top bg-hblack">
    <a class="navbar-brand text-white" href="{{ url('/') }}" style="font-family: 'Rubik', sans-serif;">
        <img src="{{asset('images/logo2.svg')}}" width="70em"> <span class="text-orange">L</span class="text-white">icense<span class="text-orange">I</span>t
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>
<div class="container">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            @auth
            <a href="" class="nav-link text-white font-weight-bold">Dashboard</a>
            @endauth
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link text-white font-weight-bold" href="{{ route('login') }}">{{ __('Login') }}</a>
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
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white font-weight-bold btn btn-orange" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                <li class="nav-item dropdown side-bar-in-nav d-xl-none">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white font-weight-bold btn btn-orange" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Navigate
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <ul>
                            @if (auth()->user()->isAdmin())
                                <li class="my-sidebar-list my-sidebar-list-shadow mx-auto @if (request()->is('dashboard')) my-sidebar-list-active @endif ">
                                    <a  href="{{route('dashboard')}}"
                                        class="d-block nav-link">
                                        <i class="fa fa-th-large pr-2" aria-hidden="true"></i> Dashboard
                                    </a>
                                </li>
                                <li class="my-sidebar-list my-sidebar-list-shadow mx-auto @if (request()->is('billing')) my-sidebar-list-active @endif ">
                                    <a  href="{{route('billing')}}"
                                        class="d-block nav-link"><i class="fa fa-file-text-o pr-2" aria-hidden="true"></i> Billing
                                    </a>
                                </li>

                                <li class="my-sidebar-list my-sidebar-list-shadow mx-auto @if (request()->is('licenses')) my-sidebar-list-active @endif ">
                                    <a  href="{{route('licenses.index')}}"
                                        class="d-block nav-link"><i class="fa fa-barcode pr-2" aria-hidden="true"></i>Manage License
                                    </a>
                                </li>
                                <li class="my-sidebar-list my-sidebar-list-shadow mx-auto @if (request()->is('software')) my-sidebar-list-active @endif ">
                                    <a  href=""
                                        class="d-block nav-link "><i class="fa fa-cogs pr-2" aria-hidden="true"></i> Manage Software
                                    </a>
                                </li>
                                <li class="my-sidebar-list my-sidebar-list-shadow mx-auto @if (request()->is('users')) my-sidebar-list-active @endif ">
                                    <a  href="{{route('users.index')}}"
                                        class="d-block nav-link "><i class="fa fa-users pr-2" aria-hidden="true"></i>Manage Users
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</div>
</nav>

