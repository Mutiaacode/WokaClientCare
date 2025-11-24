<aside class="left-sidebar" data-sidebarbg="skin6">
    <div class="scroll-sidebar" data-simplebar>

        <div class="py-4 mt-3 ">
            <img src="{{ asset('assets/images/woka1.png') }}" alt="Woka Care Logo" style="width: 140px;">
        </div>

        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                @if (auth()->user()->role === 'admin')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                            <i class="ti ti-layout-dashboard"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.users.index') }}">
                            <i class="ti ti-users"></i>
                            <span class="hide-menu">Users</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
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
                        <a class="sidebar-link" href="{{ route('admin.contract.index') }}">
                            <i class="ti ti-file-text"></i>
                            <span class="hide-menu">Contracts</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.tickets.index') }}">
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

                @if (auth()->user()->role === 'client')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('client.dashboard') }}">
                            <i class="ti ti-layout-dashboard"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('client.contract.index')  }}">
                            <i class="ti ti-file-text"></i>
                            <span class="hide-menu">Contracts</span>
                        </a>
                    </li>   
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('client.ticket.index') }}">
                            <i class="ti ti-ticket"></i>
                            <span class="hide-menu">Tickets</span>
                        </a>
                    </li>
                     <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="ti ti-receipt"></i>
                            <span class="hide-menu">Invoice</span>
                        </a>
                    </li>
                     <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="ti ti-tools"></i>
                            <span class="hide-menu">Maintenance</span>
                        </a>
                    </li>
                @endif


                {{-- Tambahkan di paling bawah --}}
                <hr class="my-3">

                <li class="sidebar-item mt-auto">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="sidebar-link btn w-100 text-start d-flex align-items-center px-3 border-0 bg-transparent"
                            style="padding-left: 14px;">
                            <i class="ti ti-logout me-2"></i>
                            <span class="hide-menu">Logout</span>
                        </button>
                    </form>
                </li>

            </ul>
        </nav>
    </div>
</aside>
