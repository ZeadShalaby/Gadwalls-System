<link rel="stylesheet" href="{{ asset('css/nav.css') }}">
<nav class="navbar">
    <div class="navbar-left">
        <img src="{{ asset('images/img/user.png') }}" alt="Profile" class="profile-img">
        <span class="username">محمد محمد</span>
        <div class="language-selector">
            <img src="{{ asset('images/img/language.png') }}" alt="language" class="lang-icon">
            <select id="language-select" style="border: none" onchange="changeLanguage()">
                <option value="ar" {{ app()->getLocale() === 'ar' ? 'selected' : '' }}>AR</option>
                <option value="en" {{ app()->getLocale() === 'en' ? 'selected' : '' }}>EN</option>
            </select>
        </div>

    </div>
    <div class="navbar-center">
        <span class="time">2:14:30 AM</span>
        <img src="{{ asset('images/img/weather.png') }}" alt="weather" class="weather-icon">
    </div>
    <div class="navbar-right">
        <button class="button sales-points">
            نقاط البيع
            <img src="{{ asset('images/img/buy.png') }}" alt="icon" class="button-icon">
        </button>
        <img src="{{ asset('images/img/plus.png') }}" alt="plus" class="icon add">
        <img src="{{ asset('images/img/notify.png') }}" alt="notify" class="icon notification">
        <img src="{{ asset('images/img/help.png') }}" alt="help" class="icon help">
        <img src="{{ asset('images/img/fullscreen.png') }}" alt="screen" class="icon full-screen">
    </div>
</nav>


<script>
    function changeLanguage() {
        const select = document.getElementById('language-select');
        const selectedLanguage = select.value;
        window.location.href = `/lang/${selectedLanguage}`;
    }
</script>
