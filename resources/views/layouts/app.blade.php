<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" sizes="20x20" href="{{ asset('images/img/logo.svg') }}" type="image/x-icon">

    <!--  Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-papHd0NInx8uQyjo/IRmEHRj2ctX6ELjF/fv/6aBBvdU9eCM5aLX+rY0kzL0CKzjswm97iZdVtR3nVGRM+7B2g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS  -->
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/notfication.css') }}">
    @include('layouts.partials.bootstrap-script')
    <title>Gadwalls-System</title>
</head>

<body>

    <!--- loading --->
    <x-loading />

    <style>
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #000000;
        }

        ::-webkit-scrollbar-thumb {
            background-image: linear-gradient(180deg, #ffc107 0%, #1B3764 99%);

            border-radius: 10px;
            transition: 0.5s;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;

        }
    </style>
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




    @include('layouts.partials.nav')

    @yield('content')

    @include('layouts.partials.scripts-datatable')

    @include('layouts.dashboard.dashboard-left')

    @include('layouts.partials.footer')

</body>


<script src="{{ asset('js/loadingall.js') }}"></script>
<script src="{{ asset('js/notification.js') }}"></script>

<!-- Notification AJAX -->
<script>
    $(document).ready(function() {
        // Handle click event for marking notification as read
        $('.mark-as-read-button').on('click', function() {
            const notificationId = $(this).closest('.notification-alert').data('id');

            $.ajax({
                url: '{{ url('/notifications/read') }}/' + notificationId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    if (response.success) {
                        $('.notification-alert[data-id="' + notificationId + '"]').addClass(
                            'animate__fadeOutRight');
                        setTimeout(function() {
                            $('.notification-alert[data-id="' + notificationId +
                                '"]').fadeOut();
                        }, 500);
                    }
                },
                error: function(xhr) {
                    console.error('Error marking notification as read:', xhr.responseText);
                }
            });
        });


    });
</script>
