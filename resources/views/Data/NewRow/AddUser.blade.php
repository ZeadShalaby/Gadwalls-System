@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/add-product.css') }}">

    <div class="container form-container">
        <h2 class="text-center mb-3" id="title">@lang('gadwalls.text-top')</h2>
        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row mb-4">
                <div class="d-flex flex-wrap w-100">

                    <!-- name -->
                    <div class="col-12 mb-2 custom-input-spacing">
                        <x-add-row :name="'name'" :type="'string'" :error="'name'" />
                    </div>

                    <!-- email -->
                    <div class="col-12 mb-2 custom-input-spacing">
                        <x-add-row :name="'email'" :type="'email'" :error="'email'" />
                    </div>

                    <!-- password -->
                    <div class="col-12 mb-2 custom-input-spacing">
                        <x-add-row :name="'password'" :type="'password'" :error="'password'" />
                    </div>

                    <!-- commercial -->
                    <div class="col-12 mb-2 custom-input-spacing">
                        <x-add-row :name="'commercial'" :type="'string'" :error="'commercial'" />
                    </div>

                    <!-- tax -->
                    <div class="col-12 mb-2 custom-input-spacing">
                        <x-add-row :name="'tax'" :type="'string'" :error="'tax'" />
                    </div>

                    <!-- address -->
                    <div class="col-12 mb-2 custom-input-spacing">
                        <x-add-row :name="'address'" :type="'string'" :error="'address'" />
                    </div>
                </div>


                <!-- button -->
                <div class="text-center w-100 my-3">
                    <button type="submit" class="btn btn-primary mx-1 share"> @lang('gadwalls.save')</button>
                </div>
            </div>
        </form>
    </div>



    <script src="{{ asset('js/add-book.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
@endsection
