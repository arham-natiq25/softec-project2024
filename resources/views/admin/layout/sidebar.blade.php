<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary bg-dark elevation-4">
    <!-- Brand Logo -->

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel text-center  mt-3 ">
            <div class="info">
                <h4 class="d-block ">AIR TRAVELERS</h4>
                <p>
                    Welcome
                    {{Auth::user()->name ?? 'Guest'}}
                </p>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{route('admin.dashboard')}}" class="nav-link text-white">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.trips')}}" class="nav-link text-white">
                        <i class="nav-icon fas fa-plane"></i>
                        <p>
                            Trips
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.query')}}" class="nav-link text-white">
                        <i class="nav-icon fas fa-plane"></i>
                        <p>
                            Query
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            this.closest('form').submit();" class="nav-link text-white">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                Log out
                            </p>
                        </a>
                    </form>

                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
