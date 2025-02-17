
<section class="home-section">
    <div class="home-content">
      <i class='fa-solid fa-bars toggle-sidebar-btn' ></i>
      <span class="text">{{ $page_name ?? $slot }}</span>
    
      <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
          <!-- Profile Dropdown Start -->
          <li class="nav-item dropdown pe-4">
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              <i class="rounded-circle fa-solid fa-user"></i>
              <span class="d-none d-md-block dropdown-toggle ps-2">Admin</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li>
                <a class="dropdown-item d-flex align-items-center" href="">
                  <i class="bi bi-person"></i>
                  <span>My Profile</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center" href="{{route('login')}}">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Log Out</span>
                </a>
              </li>
            </ul>
          </li>
          <!-- Profile Dropdown End -->
        </ul>
      </nav>
    
    </div>
</section>