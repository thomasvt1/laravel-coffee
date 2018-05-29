<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0, shrink-to-fit=no">
    {{-- CSRF token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Page title --}}
    <title>{{ config('app.name', 'Laravel') }}</title>
    {{-- TODO: Add fancy favicons --}}
    {{-- Stylesheets --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/light-bootstrap-dashboard.css') }}" rel="stylesheet">
</head>
<body>
<div class="wrapper">
    {{-- Sidebar

    data-color="purple | blue | green | orange | red"
    data-image contains an image as background
    --}}
    <div class="sidebar" data-color="blue" data-image="{{ asset('images/sidebar-5.jpg') }}">
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{ url('/') }}" class="simple-text">
                    Coffee
                </a>
            </div>
            <ul class="nav">
                <li class="nav-item active">
                    <a class="nav-link" href="">
                   <!-- <a class="nav-link" href="dashboard.html">-->
                        <i class="nc-icon nc-chart-pie-35"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="./user.html">
                        <i class="nc-icon nc-favourite-28"></i>
                        <p>Your mugs</p>
                    </a>
                </li>
               <!-- <li>
                    <a class="nav-link" href="./table.html">
                        <i class="nc-icon nc-notes"></i>
                        <p>Table List</p>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="./typography.html">
                        <i class="nc-icon nc-paper-2"></i>
                        <p>Typography</p>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="./icons.html">
                        <i class="nc-icon nc-atom"></i>
                        <p>Icons</p>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="./maps.html">
                        <i class="nc-icon nc-pin-3"></i>
                        <p>Maps</p>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="./notifications.html">
                        <i class="nc-icon nc-bell-55"></i>
                        <p>Notifications</p>
                    </a>
                </li>
                <li class="nav-item active active-pro">
                    <a class="nav-link active" href="upgrade.html">
                        <i class="nc-icon nc-alien-33"></i>
                        <p>Upgrade to PRO</p>
                    </a>
                </li>-->
            </ul>
        </div>
    </div>
    {{-- Top bar --}}
    <div class="main-panel">
        <nav class="navbar navbar-expand-lg " color-on-scroll="500">
            <div class=" container-fluid  ">
                <a class="navbar-brand" href="#pablo"> Dashboard </a>
                <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar burger-lines"></span>
                    <span class="navbar-toggler-bar burger-lines"></span>
                    <span class="navbar-toggler-bar burger-lines"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    <!--<ul class="nav navbar-nav mr-auto">
                        <li class="nav-item">
                            <a href="#" class="nav-link" data-toggle="dropdown">
                                <i class="nc-icon nc-palette"></i>
                                <span class="d-lg-none">Dashboard</span>
                            </a>
                        </li>
                        <li class="dropdown nav-item">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <i class="nc-icon nc-planet"></i>
                                <span class="notification">5</span>
                                <span class="d-lg-none">Notification</span>
                            </a>
                            <ul class="dropdown-menu">
                                <a class="dropdown-item" href="#">Notification 1</a>
                                <a class="dropdown-item" href="#">Notification 2</a>
                                <a class="dropdown-item" href="#">Notification 3</a>
                                <a class="dropdown-item" href="#">Notification 4</a>
                                <a class="dropdown-item" href="#">Another notification</a>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nc-icon nc-zoom-split"></i>
                                <span class="d-lg-block">&nbsp;Search</span>
                            </a>
                        </li>
                    </ul>-->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#pablo">
                                <span class="no-icon">{{ ucfirst(Auth::user()->name) }}</span>
                            </a>
                        </li>
                        <!--<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="no-icon">Dropdown</span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <div class="divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a>
                            </div>
                        </li> -->
                        <li class="nav-item">
							@if(Auth::check())
								<a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
									<span class="no-icon">Log out</span>

									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
								</a>
							@else
								<a class="nav-link" href="{{ route('login') }}">
									<span class="no-icon">Login</span>
								</a>
							@endif
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        {{-- Start page content --}}
        <div class="content">
            @yield('content')
        </div>
        <footer class="footer">
            <div class="container">
                <nav>
                    <ul class="footer-menu">
                       
                    <p class="copyright text-center">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                         Magic Cow
                    </p>
                </nav>
            </div>
        </footer>
    </div>
</div>
{{-- Scripts --}}
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/plugins/bootstrap-switch.js') }}"></script>
<script src="{{ asset('js/plugins/chartist.min.js') }}"></script>
<script src="{{ asset('js/plugins/bootstrap-notify.js') }}"></script>
<script src="{{ asset('js/light-bootstrap-dashboard.js') }}"></script>
@stack('scripts')
</body>
</html>
