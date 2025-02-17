<link rel="stylesheet" href="{{ asset('css/student-officer-css/mobile-view/mobile-view.css') }}">

<div class="navigation">
    <ul>
        <li class="list">
            <a href="{{route('student_officer_dashboard')}}">
                <span class="icon">
                    <i class="fa-solid fa-house"></i>
                </span>
                <span class="text">Home</span>
                <span class="circle"></span>
            </a>
        </li>
        <li class="list">
            <a href="">
                <span class="icon">
                    <i class="fa-regular fa-calendar-days"></i>
                </span>
                <span class="text">Event</span>
                <span class="circle"></span>
            </a>
        </li>
        <li class="list">
            <a href="">
                <span class="icon">
                    <i class="fa-solid fa-qrcode"></i>
                </span>
                <span class="text">Scan QR</span>
                <span class="circle"></span>
            </a>
        </li>
        <li class="list">
            <a href="">
                <span class="icon">
                    <i class="fa-solid fa-clipboard-user"></i>
                </span>
                <span class="text">Attendance</span>
                <span class="circle"></span>
            </a>
        </li>
        <li class="list">
            <a href="">
                <span class="icon">
                    <i class="fa-solid fa-user"></i>
                </span>
                <span class="text">Profile</span>
                <span class="circle"></span>
            </a>
        </li>
        <div class="indicator"></div>
    </ul>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const listItems = document.querySelectorAll(".list");
    const currentPath = window.location.pathname;

    // Apply the 'active' class to the list item matching the current route
    listItems.forEach((item) => {
        const link = item.querySelector("a");
        if (link.href.includes(currentPath)) {
            listItems.forEach((el) => el.classList.remove("active")); // Remove active from all
            item.classList.add("active"); // Set active to the matched item
        }
    });

    // Add click event for dynamic updates without reload
    listItems.forEach((item) => {
        item.addEventListener("click", function () {
            listItems.forEach((el) => el.classList.remove("active"));
            this.classList.add("active");
        });
    });
});

</script>