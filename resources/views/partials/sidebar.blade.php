<aside class="left-sidebar" data-sidebarbg="skin6">
    <div class="scroll-sidebar" data-simplebar>

        <div class="py-4 mt-3 ">
            <img src="{{ asset('assets/images/woka2.png') }}" alt="Woka Care Logo" style="width: 200px;">
        </div>

        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                {{-- ================= ADMIN ================= --}}
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
                        <a class="sidebar-link" href="{{ route('admin.invoices.index') }}">
                            <i class="ti ti-receipt"></i>
                            <span class="hide-menu">Invoices</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.payments.index') }}">
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

                {{-- ================= CLIENT ================= --}}
                @if (auth()->user()->role === 'client')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('client.dashboard') }}">
                            <i class="ti ti-layout-dashboard"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('client.contract.index') }}">
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
                        <a class="sidebar-link" href="{{ route('client.invoice.index') }}">
                            <i class="ti ti-receipt"></i>
                            <span class="hide-menu">Invoices</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('client.invoice.index') }}">
                            <i class="ti ti-tools"></i>
                            <span class="hide-menu">Maintenance</span>
                        </a>
                    </li>
                @endif

                {{-- ================= STAFF ================= --}}
                @if (auth()->user()->role === 'staff')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('staff.dashboard') }}">
                            <i class="ti ti-layout-dashboard"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('staff.tickets.index') }}">
                            <i class="ti ti-ticket"></i>
                            <span class="hide-menu">Tickets</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('staff.invoices.index') }}">
                            <i class="ti ti-ticket"></i>
                            <span class="hide-menu">invoices</span>
                        </a>
                    </li>
                @endif

                {{-- ================= TEKNISI ================= --}}
                @if (auth()->user()->role === 'teknisi')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('teknisi.dashboard') }}">
                            <i class="ti ti-layout-dashboard"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('teknisi.maintenance.index') }}">
                            <i class="ti ti-tools"></i>
                            <span class="hide-menu">Maintenance</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('teknisi.ticket.index') }}">
                            <i class="ti ti-ticket"></i>
                            <span class="hide-menu">Ticket</span>
                        </a>
                    </li>
                @endif

                {{-- ================= LOGOUT ================= --}}
                <hr class="my-3">

                <li class="sidebar-item mt-auto">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class=" btn w-100 text-start d-flex align-items-center px-3 border-0 bg-transparent">
                            <i class="ti ti-logout me-2"></i>
                            <span class="hide-menu">Logout</span>
                        </button>
                    </form>
                </li>

                {{-- ================= USER INFO ================= --}}
                <hr class="my-3">
                <li class="sidebar-item mt-auto px-3">
                    <div class="p-3" style="border-radius: 12px; background: #f7f7f7;">
                        <span class="fw-semibold d-block">{{ auth()->user()->name }}</span>
                        <small class="text-muted d-block" style="font-size: 12px;">
                            {{ ucfirst(auth()->user()->role) }}
                        </small>
                    </div>
                </li>

            </ul>
        </nav>

    </div>
</aside>
