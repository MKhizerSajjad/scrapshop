
<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{route('dashboard')}}" id="topnav-dashboard" role="button"
                        >
                            <i class="bx bx-home-circle me-1"></i>
                            <span key="t-dashboards">Dashboards</span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{route('lorry.index')}}" id="topnav-dashboard" role="button"
                        >
                            <i class="bx bx-car me-1"></i>
                            <span key="t-aitool">Lorries</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{route('purchase.index')}}" id="topnav-dashboard" role="button"
                        >
                            <i class="bx bx-receipt me-1"></i>
                            <span key="t-aitool">Purchases</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{route('sale.index')}}" id="topnav-dashboard" role="button"
                        >
                            <i class="bx bx-receipt me-1"></i>
                            <span key="t-aitool">Sales</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{route('sale.index')}}" id="topnav-dashboard" role="button"
                        >
                            <i class="bx bx-receipt me-1"></i>
                            <span key="t-aitool">Reports</span>
                            <div class="arrow-down" bis_skin_checked="1"></div>
                        </a>
                        <div class="dropdown-menu" bis_skin_checked="1">
                            <div class="dropdown" bis_skin_checked="1">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="{{route('purchase.report')}}">Purchase </a>
                                <a class="dropdown-item dropdown-toggle arrow-none" href="{{route('sale.report')}}">Sale </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
