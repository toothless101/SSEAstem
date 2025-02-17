<script src="{{asset("js/sidebartoggle.js")}}"></script>

<aside class="sidebar" id="sidebar">
    <div class="logo-details">
        <img src="{{ asset('img/tccstfi-logo.png') }}" alt="tccstfi_logo">
        <span class="logo_name">SSEAS</span>
    </div>
    <ul class="nav-links">
        <!-- Dashboard -->
        <li>
            <a href="" class="">
                <i class="fa-solid fa-house-chimney"></i>
                <span class="link_name">Home</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="">Home</a></li>
            </ul>
        </li>

            <div class="px-2 pb-2">
                <small class="d-block px-1" style="color: rgba(255, 255, 255, .6); font-size:12px;">
                    Manage
                </small>
            </div>
        

        <!--Officers-->
        <li>
            <a href="" class="">
                <i class="fa-solid fa-qrcode"></i>
                <span class="link_name">Scan QR</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="">Scan QR</a></li>
            </ul>
        </li>

        <div class="px-2 pb-2">
            <small class="d-block px-1" style="color: rgba(255, 255, 255, .6); font-size:12px;">
                Records
            </small>
        </div>

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

        <!--Attendance-->
        <li>
            <a href="" class="">
                <i class="fa-solid fa-clipboard-list"></i>
                <span class="link_name">Attendance</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="">Attendance</a></li>
            </ul>
        </li>

        <li>
            <a href="" class="">
                <i class="fa-solid fa-user"></i>
                <span class="link_name">Profile</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="">Profile</a></li>
            </ul>
        </li>
        <!-- Logout -->
        <li>
            <a href="{{route('login')}}" style=margin-top:100px>
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
   // document.addEventListener('DOMContentLoaded', function () {
    //const menuLinks = document.querySelectorAll('.nav-links li a');

//    menuLinks.forEach(link => {
//        link.addEventListener('click', function () {
//            // Remove the active class from all links
//            menuLinks.forEach(item => item.classList.remove('active'));

//            // Add the active class to the clicked link
//            this.classList.add('active');
//        });
//    });
//});


document.addEventListener('DOMContentLoaded', function () {
    const sidebarLinks = document.querySelectorAll('.nav-links li a');
    const bottomNavLinks = document.querySelectorAll('.navigation ul li a');

    function handleActiveClass(event) {
        const allLinks = [...sidebarLinks, ...bottomNavLinks];
        allLinks.forEach(link => link.classList.remove('active')); // Remove active class from all links
        const clickedLink = event.target.closest('a'); // Get the clicked link
        if (clickedLink) {
            clickedLink.classList.add('active'); // Add active class to the clicked link
        }
    }

    sidebarLinks.forEach(link => link.addEventListener('click', handleActiveClass));
    bottomNavLinks.forEach(link => link.addEventListener('click', handleActiveClass));
});


</script>