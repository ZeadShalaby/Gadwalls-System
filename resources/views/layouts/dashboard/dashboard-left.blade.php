<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<!----===== Boxicons CSS ===== -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet" />
<nav class="sidebar"> <!-- إزالة الفئة 'close' -->
    <header>
        <div class="image-text">
            <div class="text logo-text" style=" margin-left: 38px;margin-top: 16px;width: 70%">
                <img src="{{ asset('images/img/icon.png') }}" alt="logo" />
            </div>
        </div>

    </header>

    <div class="menu-bar" style="margin-top: -40px">
        <div class="menu" style="margin-left: -45px">
            <div class="ml-auto d-flex align-items-center">
                <a href="{{ url('/lang/en') }}" class="nav-link text-dark"
                    style="font-size: 20px; text-decoration: none; color: rgb(211, 214, 216);">
                    <i class="fas fa-globe-americas"></i> <!-- English icon -->
                </a>
                <span class="mx-2">|</span>
                <a href="{{ url('/lang/ar') }}" class="nav-link text-dark"
                    style="font-size: 20px; text-decoration: none; color: rgb(211, 214, 216);">
                    <i class="fas fa-globe"></i> <!-- Arabic icon -->
                </a>
            </div>

            <li class="search-box">
                <i class="bx bx-search icon"></i>
                <input type="text" placeholder="Search..." />
            </li>

            <!-- باقي عناصر القائمة الجانبية -->
            <ul class="menu-links">
                <li class="nav-link">
                    <a href="#">
                        <i class="bx bx-home-alt icon"></i>
                        <span class="text nav-text">sss</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class="fas fa-add icon"></i>
                        <span class="text nav-text">ss</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class="bx bx-bar-chart-alt-2 icon"></i>
                        <span class="text nav-text">jkjj</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class="bx bx-bell icon"></i>
                        <span class="text nav-text">www</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class="fas fa-book icon" style="font-size: 17px;"></i>
                        <span class="text nav-text">www</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="#">
                        <i class="fas fa-comment-alt icon" style="font-size: 17px;"></i>
                        <span class="text nav-text">wwwww</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="#">
                        <i class="fas fa-user-alt icon" style="font-size: 17px;"></i>
                        <span class="text nav-text">wwww</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="#">
                        <i class="bx bx-trash icon"></i>
                        <span class="text nav-text">wwww</span>
                    </a>
                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>

        <div class="bottom-content">
            <li>
                <a href="#">
                    <i class="bx bx-log-out icon"></i>
                    <span class="text nav-text">wwww</span>
                </a>
                <div class="toggle-switch">
                    <span class="switch"></span>
                </div>
            </li>

            <li class="mode">
                <div class="sun-moon">
                    <i class="bx bx-moon icon moon"></i>
                    <i class="bx bx-sun icon sun"></i>
                </div>
                <span class="mode-text text">www</span>

                <div class="toggle-switch">
                    <span class="switch"></span>
                </div>
            </li>
        </div>
    </div>
</nav>


<script src="{{ asset('js/dashboard.js') }}"></script>
