<nav class="navbar">
    <div class="navbar-left">
        <img class="profile-img"
            src="{{ Auth::check() && Auth::user()->load('media_one')->media_one ? asset(Auth::user()->media_one->media) : asset('images/users/users.png') }}"
            alt="{{ Auth::check() && Auth::user()->media_one && Auth::user()->media_one->media ? asset(Auth::user()->media_one->media) : 'default_alt_text' }}" />
        <span class="username">
            @if (Auth::check())
                {{ Auth::user()->name }}
            @else
            @endif

        </span>

        <!--- notification --->
        @if (auth()->check() && auth()->user()->notifications->isNotEmpty())
            <div class="notification-container">
                @foreach (auth()->user()->unreadNotifications as $notification)
                    <div class="alert alert-info notification-alert" data-id="{{ $notification->id }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $notification->data['message'] }}</strong>
                            </div>
                            <button type="button" class="btn btn-success btn-sm mark-as-read-button">
                                <i class="fas fa-check"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

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

        <a href="{{ route(Session::get('route') ?? 'loginindex') }}">
            <img src="{{ asset('images/img/plus.png') }}" alt="plus" class="icon add">
        </a>

        @if (Session::get('route') === 'product.new')
            <form id="upload-form" action="{{ route('product.importExcel') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="file" id="excel-file" name="file" class="file-input" accept=".xlsx, .xls"
                    onchange="uploadFile(event)">
                <label for="excel-file">
                    <img src="{{ asset('images/img/file.png') }}" alt="notify" class="icon notification">
                </label>
            </form>
        @endif

        <img src="{{ asset('images/img/notify.png') }}" alt="notify" class="icon notification">
        <img src="{{ asset('images/img/help.png') }}" alt="help" class="icon help">
        <img src="{{ asset('images/img/fullscreen.png') }}" alt="screen" class="icon full-screen">
    </div>
</nav>

<div id="loading-page" style="display: none;">
    <x-loadings />
</div>

<script>
    // change language
    function changeLanguage() {
        const select = document.getElementById('language-select');
        const selectedLanguage = select.value;
        window.location.href = `/lang/${selectedLanguage}`;
    }

    // ? Function to upload file
    function uploadFile(event) {
        var formData = new FormData($('#upload-form')[0]);

        $.ajax({
            url: "{{ route('product.importExcel') }}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                document.getElementById('loading-page').style.display = 'block';
                setTimeout(function() {
                    // Reload the page after 1 second
                    window.location.reload(true);
                }, (response.data.time * 1000) - 1000); // Subtracting 1000 milliseconds
            },
            error: function(xhr) {
                var errorMessage = "{{ __('certificate.upload_error') }}";
                alert(errorMessage);
            }
        });
    }
</script>
