@include('layouts.partials.nav')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<link rel="stylesheet" href="{{ asset('css/navlogin.css') }}">

<!--- loading --->
{{-- <x-loadings /> --}}

<div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="container">
        <div class="row justify-content-center">
            <div class=" test col-12 col-sm-10 col-md-8 col-lg-6">
                <div id="card" class="card p-4 mt-5">
                    <h3 class="text-center">@lang('gadwalls.login')</h3>
                    <form class="rounded p-4" action="{{ route('login') }}" method="POST">
                        {{ csrf_field() }}

                        <!--- Login input --->
                        <div class="form-group">
                            <x-inputfield :name="'email'" :placeholder="'email_placeholder'" :type="'email'" :error="'email'" />
                        </div>
                        <div class="form-group">
                            <x-inputfield :name="'password'" :placeholder="'pass_placeholder'" :type="'password'" :error="'password'" />
                        </div>

                        <!-- Adjusted alignment to center -->
                        <div class="d-flex justify-content-center">
                            <a href="#" class="text-primary">@lang('gadwalls.forgot_password')</a>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-block mt-3" id="login">
                                @lang('gadwalls.login')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.partials.bootstrap-script')
<script src="{{ asset('js/loadingall.js') }}"></script>
