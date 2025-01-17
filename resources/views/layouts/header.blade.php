<header class="main-header">
    <a href="{{ url('/home') }}" class="logo" style="text-decoration:none">
    <span class="logo-mini">Website</span>
    <span class="logo-lg"> <img src="{{ url('assets/img/avatar5.png') }}" height="205px"> Website</span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" style="text-decoration:none">
        <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ url('assets/img/avatar5.png') }}" class="user-image" alt="User Image">
                    <span class="hidden-xs">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{ url('assets/img/avatar5.png') }}" class="img-circle" alt="User Image">
                            <p>
                                Website
                                <small>{{ auth()->user()->name }}</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="" class="btn btn-default btn-flat">Profile <i class="fa fa-user-md"></i></a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('/logout') }}" class="btn btn-default btn-flat"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                Logout <i class="fa fa-sign-out"></i>
                                </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>