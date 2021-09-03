<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown nav-link"
                            href="{{ url('/') }}"><i class="fe-airplay mr-1"></i>Dashboard</a>
                    </li>
                    @if (Auth()->user()->role_id == 1)
                        <li class="dropdown nav-item" data-menu="dropdown"><a
                                class="dropdown nav-link {{ request()->is('users') ? 'active' : '' }}"
                                href="{{ url('users') }}"><i class="fe-briefcase mr-1"></i>Users Data</a>
                        </li>
                        <li class="dropdown nav-item" data-menu="dropdown"><a href="{{ url('products') }}"
                                class="dropdown nav-link {{ request()->is('products') ? 'active' : '' }}"><i
                                    class="fe-calendar mr-1"></i> Products Data</a>
                        </li>
                        <li class="dropdown nav-item" data-menu="dropdown"><a href="{{ url('sales') }}"
                                class="dropdown nav-link {{ request()->is('sales') ? 'active' : '' }}"><i
                                    class="fe-calendar mr-1"></i> Sales Data</a>
                        </li>
                        <li class="dropdown nav-item" data-menu="dropdown"><a href="{{ url('perhitungan') }}"
                                class="dropdown nav-link {{ request()->is('perhitungan') ? 'active' : '' }}"><i
                                    class="fe-calendar mr-1"></i> Perhitungan</a>
                        </li>
                    @endif


                </ul> <!-- end navbar-->
            </div> <!-- end .collapsed-->
        </nav>
    </div> <!-- end container-fluid -->
</div> <!-- end topnav-->
