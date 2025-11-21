<header class="topbar d-flex justify-content-between align-items-center px-4 py-2 bg-white shadow-sm">
  <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center">
    <img src="{{ asset('assets/images/logos/logo.svg') }}" alt="Logo" width="130">
  </a>

  <div class="dropdown">
    <a class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" href="#" data-bs-toggle="dropdown">
      <img src="{{ asset('assets/images/users/1.jpg') }}" alt="user" class="rounded-circle" width="35">
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
      <li><a class="dropdown-item" href="#">Profile</a></li>
      <li><a class="dropdown-item" href="#">Settings</a></li>
      <li><hr class="dropdown-divider"></li>
      <li>
        <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
      </li>
    </ul>
  </div>
</header>
