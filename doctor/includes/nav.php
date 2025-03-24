<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.html">Roy Medical Doctor</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
</nav>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link" href="/rm/doctor/index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>

                    <!-- account section -->
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsProfile" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas far fa-user-circle"></i></div>
                        Profile
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayoutsProfile" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="#">My Account</a>
                            <a class="nav-link" href="#">Logout</a>
                        </nav>
                    </div>

                    <!-- manage section -->
                    <a class="nav-link" href="/rm/doctor/appointment_list.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Appointments
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">All Rights Reserved &copy;</div>
                Roy Medical
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">