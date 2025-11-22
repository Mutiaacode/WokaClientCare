<aside class="left-sidebar" data-sidebarbg="skin6">
    <div class="scroll-sidebar" data-simplebar>

        <div class="py-4 mt-3 ">
            <img src="{{ asset('assets/images/woka1.png') }}" alt="Woka Care Logo" style="width: 140px;">
        </div>

        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                {{-- ========== ADMIN ========== --}}
                @if (auth()->user()->role === 'admin')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                            <i class="ti ti-layout-dashboard"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="ti ti-users"></i>
                            <span class="hide-menu">Users</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.clients.index') }}">
                            <i class="ti ti-user"></i>
                            <span class="hide-menu">Clients</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.product.index') }}">
                            <i class="ti ti-package"></i>
                            <span class="hide-menu">Products</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="ti ti-file-text"></i>
                            <span class="hide-menu">Contracts</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="ti ti-ticket"></i>
                            <span class="hide-menu">Tickets</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="ti ti-history"></i>
                            <span class="hide-menu">Ticket Logs</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="ti ti-receipt"></i>
                            <span class="hide-menu">Invoices</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="ti ti-credit-card"></i>
                            <span class="hide-menu">Payments</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="ti ti-tools"></i>
                            <span class="hide-menu">Maintenance</span>
                        </a>
                    </li>
                @endif



                {{-- ========== STAFF ========== --}}
                @if (auth()->user()->role === 'staff')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="ti ti-layout-dashboard"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="ti ti-ticket"></i>
                            <span class="hide-menu">Tickets</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="ti ti-history"></i>
                            <span class="hide-menu">Ticket Logs</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="ti ti-user"></i>
                            <span class="hide-menu">Clients</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="ti ti-file-text"></i>
                            <span class="hide-menu">Contracts</span>
                        </a>
                    </li>
                @endif



                {{-- ========== TEKNISI ========== --}}
                @if (auth()->user()->role === 'teknisi')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="ti ti-layout-dashboard"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="ti ti-tools"></i>
                            <span class="hide-menu">Maintenance</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="ti ti-ticket"></i>
                            <span class="hide-menu">Tickets</span>
                        </a>
                    </li>
                @endif



                {{-- ========== CLIENT ========== --}}
                @if (auth()->user()->role === 'client')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="ti ti-layout-dashboard"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="ti ti-ticket"></i>
                            <span class="hide-menu">Tickets</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="ti ti-file-text"></i>
                            <span class="hide-menu">Contracts</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="ti ti-receipt"></i>
                            <span class="hide-menu">Invoices</span>
                        </a>
                    </li>
                @endif

            </ul>
        </nav>
    </div>
</aside>
