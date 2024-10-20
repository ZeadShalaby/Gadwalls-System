@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/add-product.css') }}">


    <div class="container form-container">
        <h2 class="text-center mb-3" id="title">@lang('gadwalls.comapany-name')</h2>
        <form action="#" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row mb-4">
                <div class="d-flex flex-wrap w-100 justify-content-between">

                    <!-- name -->
                    <div class="col-md-5 mb-2 custom-input-spacing">
                        <x-add-row :name="'company_name'" :type="'text'" :error="'company_name'" />
                    </div>

                    <!-- suppliers -->
                    <div class="col-md-5 mb-2 custom-input-spacing">
                        <x-select :name="'phone'" :type="'number'" :error="'phone'" />
                    </div>

                    <!-- quantity -->
                    <div class="col-md-5 mb-2 custom-input-spacing">
                        <x-add-row :name="'email'" :type="'email'" :error="'email'" />
                    </div>


                    <!-- file upload -->
                    <div class="col-md-5 mb-2 custom-input-spacing position-relative">
                        <label class="form-label text-end d-block"> @lang('gadwalls.fileupload')
                        </label>

                        <label for="fileUpload" class="custom-file-upload">
                            <i class="bx bx-upload" id="fileIcon"></i>
                            <span>رفع صورة</span>
                            <input type="file" id="fileUpload" name="fileUpload" accept="image/*" required />
                        </label>
                        <span class="error" id="fileError" style="display: none;">يجب رفع صورة.</span>
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
