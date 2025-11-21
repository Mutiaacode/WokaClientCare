<aside class="left-sidebar" data-sidebarbg="skin6">
    <div class="scroll-sidebar" data-simplebar>

        <!-- LOGO / TITLE -->
        <div class=" py-4 mt-3">
            <img src="{{ asset('assets/images/woka1.png') }}" alt="Woka Care Logo" style="width: 140px; height:auto;">
        </div>


        <!-- Sidebar navigation -->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                        <i class="ti ti-layout-dashboard"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <i class="ti ti-news"></i>
                        <span class="hide-menu">Berita</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link"><span class="hide-menu"> Tambah Berita </span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link"><span class="hide-menu"> Daftar Berita </span></a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <i class="ti ti-users"></i>
                        <span class="hide-menu">Users</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link"><span class="hide-menu"> Tambah User </span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link"><span class="hide-menu"> Daftar User </span></a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="#">
                        <i class="ti ti-activity"></i>
                        <span class="hide-menu">Reports</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="#">
                        <i class="ti ti-settings"></i>
                        <span class="hide-menu">Settings</span>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
