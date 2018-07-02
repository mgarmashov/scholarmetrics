<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ route('index') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>SM</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Scholarmetrics</b></span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> {{ __('Logout') }}</a></li>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </ul>
        </div>
    </nav>
</header>
