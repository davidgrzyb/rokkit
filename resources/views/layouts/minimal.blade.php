<!doctype html>
<html lang="{{ config('app.locale') }}" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Rokkit - Advertise During URL Redirects!</title>

        <meta name="description" content="Advertise to customers during your shortened URL redirects - even using your own domain!">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Icons -->
        <link rel="shortcut icon" href="{{ asset('storage/favicon.png') }}">

        <!-- Fonts and Styles -->
        @yield('css_before')
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="{{ mix('/css/codebase.css') }}">

        @yield('css_after')

        <!-- Scripts -->
        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
    </head>
    <body>
        <!-- Page Container -->
        <!--
            Available classes for #page-container:

        GENERIC

            'enable-cookies'                            Remembers active color theme between pages (when set through color theme helper Template._uiHandleTheme())

        SIDEBAR & SIDE OVERLAY

            'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
            'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
            'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
            'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
            'sidebar-inverse'                           Dark themed sidebar

            'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
            'side-overlay-o'                            Visible Side Overlay by default

            'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

            'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

        HEADER

            ''                                          Static Header if no class is added
            'page-header-fixed'                         Fixed Header

        HEADER STYLE

            ''                                          Classic Header style if no class is added
            'page-header-modern'                        Modern Header style
            'page-header-inverse'                       Dark themed Header (works only with classic Header style)
            'page-header-glass'                         Light themed Header with transparency by default
                                                        (absolute position, perfect for light images underneath - solid light background on scroll if the Header is also set as fixed)
            'page-header-glass page-header-inverse'     Dark themed Header with transparency by default
                                                        (absolute position, perfect for dark images underneath - solid dark background on scroll if the Header is also set as fixed)

        MAIN CONTENT LAYOUT

            ''                                          Full width Main Content if no class is added
            'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
            'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)
        -->
        <div id="page-container" class="sidebar-inverse side-scroll main-content-boxed">

            <!-- Sidebar -->
            <nav id="sidebar">
                <!-- Sidebar Content -->
                <div class="sidebar-content">
                    <!-- Side Header -->
                    <div class="content-header content-header-fullrow bg-black-op-10">
                        <div class="content-header-section text-center align-parent">
                            <!-- Close Sidebar, Visible only on mobile screens -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                                <i class="fa fa-times text-danger"></i>
                            </button>
                            <!-- END Close Sidebar -->

                            <!-- Logo -->
                            <div class="content-header-item">
                                <a class="link-effect font-w700" href="{{ url('/dashboard') }}">
                                    <i class="si si-rocket text-primary"></i>
                                    <span class="font-size-xl text-dual-primary-dark">rokk</span><span class="font-size-xl text-primary">it</span>
                                </a>
                            </div>
                            <!-- END Logo -->
                        </div>
                    </div>
                    <!-- END Side Header -->

                    <!-- Side Main Navigation -->
                    <div class="content-side content-side-full">
                        <!--
                        Mobile navigation, desktop navigation can be found in #page-header

                        If you would like to use the same navigation in both mobiles and desktops, you can use exactly the same markup inside sidebar and header navigation ul lists
                        -->
                        @if(auth()->check())
                            <ul class="nav-main">
                                <li>
                                    <a href="{{ url('/dashboard') }}"><i class="si si-cup"></i>Dashboard</a>
                                </li>
                                <li>
                                    <a href="{{ url('/links/create') }}"><i class="si si-plus"></i>Create New Link</a>
                                </li>
                                <li>
                                    <a href="{{ url('/links') }}"><i class="si si-rocket"></i>Links</a>
                                </li>
                                <li>
                                    <a href="{{ url('/domains') }}"><i class="si si-link"></i>Domains</a>
                                </li>
                                <li>
                                    <a href="{{ url('/account') }}"><i class="si si-user"></i>Account</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="si si-logout"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        @else
                            <ul class="nav-main">
                                <li>
                                    <a href="{{ url('/login') }}"><i class="si si-user"></i>Login</a>
                                </li>
                                <li>
                                    <a href="{{ url('/register') }}"><i class="si si-plus"></i>Register</a>
                                </li>
                            </ul>
                        @endif
                    </div>
                    <!-- END Side Main Navigation -->
                </div>
                <!-- Sidebar Content -->
            </nav>
            <!-- END Sidebar -->

            <!-- Header -->
            <header id="page-header">
                <!-- Header Content -->
                <div class="content-header">
                    <!-- Left Section -->
                    <div class="content-header-section">
                        <!-- Logo -->
                        <div class="content-header-item mr-5">
                            <a class="link-effect font-w700" href="{{ url('/dashboard') }}">
                                <i class="si si-rocket text-primary"></i>
                                <span class="font-size-xl text-dual-primary-dark">rokk</span><span class="font-size-xl text-primary">it</span>
                            </a>
                        </div>
                        <!-- END Logo -->
                    </div>
                    <!-- END Left Section -->

                    <!-- Right Section -->
                    <div class="content-header-section">
                        <!-- Header Navigation -->
                        <!--
                        Desktop Navigation, mobile navigation can be found in #sidebar

                        If you would like to use the same navigation in both mobiles and desktops, you can use exactly the same markup inside sidebar and header navigation ul lists
                        If your sidebar menu includes headings, they won't be visible in your header navigation by default
                        If your sidebar menu includes icons and you would like to hide them, you can add the class 'nav-main-header-no-icons'
                        -->
                        <ul class="nav-main-header">
                            @if(auth()->check())
                                <li>
                                    <a class="btn btn-md" href="{{ url('/links/create') }}">
                                        <i class="si si-plus"></i> Create New Link
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-submenu btn btn-md" data-toggle="nav-submenu" href="#">
                                        <i class="si si-layers"></i> Menu
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="{{ url('/dashboard') }}"><i class="si si-cup"></i>Dashboard</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/links') }}"><i class="si si-rocket"></i>Links</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/domains') }}"><i class="si si-link"></i>Domains</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/account') }}"><i class="si si-user"></i>Account</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="si si-logout"></i> {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @else
                                <li>
                                    <a class="btn btn-md" href="{{ url('/login') }}">
                                        <i class="si si-user"></i> Login
                                    </a>
                                </li>
                            @endif
                        </ul>
                        <!-- END Header Navigation -->

                        <!-- Toggle Sidebar -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-dual-secondary d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                            Menu <i class="fa fa-navicon ml-5"></i>
                        </button>
                        <!-- END Toggle Sidebar -->
                    </div>
                    <!-- END Right Section -->
                </div>
                <!-- END Header Content -->

                <!-- Header Search -->
                <div id="page-header-search" class="overlay-header">
                    <div class="content-header content-header-fullrow">
                        <form>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <!-- Close Search Section -->
                                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                    <button type="button" class="btn btn-secondary px-15" data-toggle="layout" data-action="header_search_off">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <!-- END Close Search Section -->
                                </div>
                                <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-secondary px-15">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END Header Search -->

                <!-- Header Loader -->
                <div id="page-header-loader" class="overlay-header bg-primary">
                    <div class="content-header content-header-fullrow text-center">
                        <div class="content-header-item">
                            <i class="fa fa-sun-o fa-spin text-white"></i>
                        </div>
                    </div>
                </div>
                <!-- END Header Loader -->
            </header>
            <!-- END Header -->

            <!-- Main Container -->
            <main id="main-container">
                @yield('content')
            </main>
            <!-- END Main Container -->

            <!-- Footer -->
            <footer id="page-footer" class="bg-white opacity-0">
                <div class="content py-20 font-size-sm clearfix">
                    <div class="float-right">
                        Built <!-- with <i class="fa fa-heart text-pulse"></i> --> by <a class="font-w600" href="https://davidgrzyb.com" target="_blank">David Grzyb</a>
                    </div>
                    <div class="float-left">
                        <a class="font-w600" href="https://rokk.it" target="_blank">rokk.it</a> &copy; <span class="js-year-copy"></span>
                    </div>
                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->

        <!-- Codebase Core JS -->
        <script src="{{ mix('js/codebase.app.js') }}"></script>

        <!-- Laravel Scaffolding JS -->
        <!-- <script src="{{ mix('js/laravel.app.js') }}"></script> -->

        <!-- @yield('livewire') -->
        @yield('js_after')
    </body>
</html>
