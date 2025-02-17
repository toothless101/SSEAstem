<script src="{{asset("js/sidebartoggle.js")}}"></script>

<aside class="sidebar" id="sidebar">
    <div class="logo-details">
        <img src="{{ asset('img/tccstfi-logo.png') }}" alt="tccstfi_logo">
        <span class="logo_name">SSEAS</span>
    </div>
    <ul class="nav-links">
        <!-- Dashboard -->
        <li>
            <a href="{{route('admin_dashboard')}}" class="{{request()->routeIs('admin_dashboard') ? 'active' : ''}}">
                <i class="fa-solid fa-gauge-high"></i>
                <span class="link_name">Dashboard</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('admin_dashboard') }}">Dashboard</a></li>
            </ul>
        </li>

            <div class="px-2 pb-2">
                <small class="d-block px-1" style="color: rgba(255, 255, 255, .6); font-size:12px;">
                    Manage
                </small>
            </div>

        
        {{-- School Year --}}
        <li>
            <a href="{{route('manage_schoolyear')}}" class="{{request()->routeIs('manage_schoolyear') ? 'active' : ''}}">
                <i class="fa-solid fa-school"></i>
                <span class="link_name">School Year</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="">School Year</a></li>
            </ul>
        </li>

        <!--Officers-->
        {{-- <li>
            <div class="iocn-link">
                <a href="{{route('manage_officer')}}" class="{{request()->routeIs('manage_officer') ? 'active' : ''}}">
                    <i class="fa-solid fa-user"></i>
                    <span class="link_name">Users</span>
                    <i class='bx bxs-chevron-down arrow' ></i>
                </a>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="">Admin</a></li>
                <li><a href="{{route('manage_officer')}}" class="">Student Officers</a></li>
            </ul>
        </li> --}}


        {{-- USERS --}}
        <li>
            <div class="iocn-link">
              <a href="#" disabled>
                <i class="fa-solid fa-user"></i>
                <span class="link_name">Users</span>
              </a>
              <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
                <li><h5 class="link_name" style="color:white;">Users</h5></li>
                <li><a href="{{route('admin_page')}}" class="{{request()->routeIs('admin_page') ? 'active-sub' : ''}}">Admin</a></li>
                <li><a href="{{route('manage_officer')}}" class="{{request()->routeIs('manage_officer') ? 'active-sub' : ''}}">Student Officers</a></li>
            </ul>
          </li>

        <!-- Events -->
        <li>
            <a href="{{route('manage_event')}}" class="{{request()->routeIs('manage_event') ? 'active' : ''}}">
                <i class="fa-solid fa-calendar-days"></i>
                <span class="link_name">Events</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="">Events</a></li>
            </ul>
        </li>

        <!-- Attendees -->
        <li>
            <a href="" class="">
                <i class="fa-solid fa-users"></i>
                <span class="link_name">Attendees</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="">Attendees</a></li>
            </ul>
        </li>

        <div class="px-2 pb-2">
            <small class="d-block px-1" style="color: rgba(255, 255, 255, .6); font-size:12px;">
                Reports
            </small>
        </div>

        <!-- Attendance -->
        <li>
            <a href="" class="">
                <i class="fa-solid fa-clipboard-list"></i>
                <span class="link_name">Attendance</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="">Attendance</a></li>
            </ul>
        </li>

        <!--REPORTS-->
        <li>
            <a href="" class="">
                <i class="fa-solid fa-layer-group"></i>
                <span class="link_name">Report</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="">Report</a></li>
            </ul>
        </li>

        <div class="px-2 pb-2">
            <small class="d-block px-1" style="color: rgba(255, 255, 255, .6); font-size:12px;">
                Settings
            </small>
        </div>

        <!--Validation-->
        <li>
            <a href="" class="">
                <i class="bi bi-check-circle-fill"></i>
                <span class="link_name">Validation</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="">Validation</a></li>
            </ul>
        </li>


        <!-- Logout -->
        <li>
            <a href="{{route('admin_logout')}}" style="margin-top: 15px;">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span class="link_name logout">Log Out</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Log Out</a></li>
            </ul>
        </li>


    </ul>
</aside>

{{-- <style>
    .nav-links li a.active{
        /* background-color:rgba(54, 17, 17, .70); */
        color: white;
    }
    .nav-links li .sub-menu  a.activesub{
        color: white !important;
        background-color: transparent;
    }

</style> --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const menuLinks = document.querySelectorAll('.nav-links li a');

    menuLinks.forEach(link => {
        link.addEventListener('click', function () {
            // Remove the active class from all links
            menuLinks.forEach(item => item.classList.remove('active'));

            // Add the active class to the clicked link
            this.classList.add('active');
        });
    });
});

</script>