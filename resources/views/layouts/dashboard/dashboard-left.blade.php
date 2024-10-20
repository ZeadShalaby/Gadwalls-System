<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet" />

<nav class="sidebar">
    <header>
        <div class="image-text">
            <div class="text logo-text" style="margin-left: 38px; margin-top: 16px; width: 70%">
                <img src="{{ asset('images/img/icon.png') }}" alt="logo" />
            </div>
        </div>
    </header>
    <br />

    <div class="menu-bar" style="margin-top: -40px">
        <div class="menu" style="margin-left: -45px">
            <div class="ml-auto d-flex align-items-center">
                <a href="{{ url('/lang/en') }}" class="nav-link text-dark"
                    style="font-size: 20px; text-decoration: none; color: rgb(211, 214, 216);"></a>
                <a href="{{ url('/lang/ar') }}" class="nav-link text-dark"
                    style="font-size: 20px; text-decoration: none; color: rgb(211, 214, 216); margin-left: 10px;"></a>
            </div>

            <li class="search-box">
                <i class="bx bx-search icon" style="color:#222751; margin-left: 50px;"></i>
                <input type="text" placeholder="@lang('gadwalls.search')" />
            </li>
            <ul class="menu-links">


                <li class="nav-link">
                    <a href="{{ route('homeindex') }}">
                        <i class="bx bx-home-alt icon"></i>
                        <span class="text nav-text">@lang('gadwalls.home')</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="{{ route('product.table') }}">
                        <i class="fas fa-plus icon"></i>
                        <span class="text nav-text">@lang('gadwalls.products')</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="{{ route('store.table') }}">
                        <i class="bx bx-bar-chart-alt-2 icon"></i>
                        <span class="text nav-text">@lang('gadwalls.stores')</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="{{ route('stock.table') }}">
                        <i class="bx bx-bell icon"></i>
                        <span class="text nav-text">@lang('gadwalls.stocks')</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="{{ route('supplier.table') }}">
                        <i class="fas fa-book icon" style="font-size: 17px;"></i>
                        <span class="text nav-text">@lang('gadwalls.suppliers')</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="{{ route('user.table') }}">
                        <i class="fas fa-users icon" style="font-size: 17px;"></i>
                        <span class="text nav-text">@lang('gadwalls.users')</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="{{ route('salebill.table') }}">
                        <i class="fas fa-file-invoice-dollar icon" style="font-size: 17px;"></i>
                        <span class="text nav-text">@lang('gadwalls.salebill')</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="bottom-content">
            <li>
                <a href="{{ route('logout') }}">
                    <i class="bx bx-log-out icon"></i>
                    <span class="text nav-text" style="margin-top: 10px">@lang('gadwalls.logout')</span>
                </a>
            </li>
        </div>
    </div>
</nav>

<script src="{{ asset('js/dashboard.js') }}"></script>
