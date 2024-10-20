@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/add-product.css') }}">

    <div class="container form-container">
        <h2 class="text-center mb-3" id="title">@lang('gadwalls.text-top')</h2>
        <form action="{{ route('product.update') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row mb-4">
                <div class="d-flex flex-wrap w-100 justify-content-between">

                    <!-- name -->
                    <div class="col-md-5 mb-2 custom-input-spacing">
                        <x-add-row :name="'name'" :type="'string'" :error="'name'" />
                    </div>

                    <!-- suppliers -->
                    <div class="col-md-5 mb-2 custom-input-spacing">
                        <x-select :name="'supplier_id'" :error="'supplier_id'" :select="$suppliers" />
                    </div>

                    <!-- stores -->
                    <div class="col-md-5 mb-2 custom-input-spacing">
                        <x-select :name="'store_id'" :error="'store_id'" :select="$stores" />
                    </div>

                    <!-- quantity -->
                    <div class="col-md-5 mb-2 custom-input-spacing">
                        <x-add-row :name="'quantity'" :type="'number'" :error="'quantity'" />
                    </div>

                    <!-- expire_date -->
                    <div class="col-md-5 mb-2 custom-input-spacing">
                        <x-add-row :name="'expire_date'" :type="'date'" :error="'expire_date'" />
                    </div>

                    <!-- price -->
                    <div class="col-md-5 mb-2 custom-input-spacing">
                        <x-add-row :name="'price'" :type="'number'" :error="'price'" />
                    </div>

                    <!--  scan code  -->
                    <div class="col-md-5 mb-2 custom-input-spacing">
                        <label for="code" class="form-label text-end d-block">@lang('gadwalls.code')</label>
                        <div class="d-flex align-items-center">
                            <button type="button" id="barcode" class="barcode-btn">
                                <img src="{{ asset('images/img/scan.png') }}" alt="barcode" />
                            </button>
                            <x-add-row :name="'code'" :type="'string'" :error="'code'" />
                        </div>
                    </div>

                </div>

                <!-- button -->
                <div class="text-center w-100 my-3">
                    <button type="submit" class="btn btn-primary mx-1 share"> @lang('gadwalls.save')</button>
                </div>
            </div>
        </form>
    </div>



    <script src="{{ asset('js/setting.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
@endsection
