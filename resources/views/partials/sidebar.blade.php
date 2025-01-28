<script src="{{asset("js/sidebartoggle.js")}}"></script>

<aside class="sidebar" id="sidebar">
    <div class="logo-details">
        <img src="{{ asset('img/tccstfi-logo.png') }}" alt="tccstfi_logo">
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
        

        <!--Officers-->
        <li>
            <a href="{{route('manage_officer')}}" class="{{request()->routeIs('manage_officer') ? 'active' : ''}}">
                <i class="fa-solid fa-user"></i>
                <span class="link_name">Officers</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="">Officers</a></li>
            </ul>
        </li>

        <!-- Events -->
        <li>
            <a href="" class="">
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
        <!-- Logout -->
        <li>
            <a href="{{route('admin_logout')}}" style=margin-top:100px>
                <i class="fa-solid fa-right-from-bracket"></i>
                <span class="link_name logout">Log Out</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Log Out</a></li>
            </ul>
        </li>
    </ul>
</aside>

<style>
    .nav-links li a.active{
        background-color:rgba(54, 17, 17, .90);
    }

</style>
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