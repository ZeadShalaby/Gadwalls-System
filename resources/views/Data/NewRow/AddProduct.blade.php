@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/add-product.css') }}">

    <div class="container form-container">
        <h2 class="text-center mb-3" id="title">@lang('gadwalls.text-top')</h2>
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" id="upload-form">
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

                    <!-- scan code -->
                    <div class="col-md-5 mb-2 custom-input-spacing">
                        <label for="code" class="form-label text-end d-block">@lang('gadwalls.code')</label>
                        <div class="d-flex align-items-center">
                            <button type="button" id="barcode" class="barcode-btn">
                                <img src="{{ asset('images/img/scan.png') }}" alt="barcode" />
                            </button>
                            <x-add-row :name="'code'" :type="'string'" :error="'code'" />
                        </div>
                    </div>

                    <!-- file upload -->
                    <div class="col-md-5 mb-2 custom-input-spacing">
                        <label for="files" class="form-label">@lang('gadwalls.upload_files') (حتى 7 ملفات)</label>
                        <input type="file" id="files" name="files[]" multiple class="form-control">
                        <p id="file-error" style="color: red; display: none;"></p> <!-- رسالة الخطأ -->
                    </div>

                </div>

                <!-- button -->
                <div class="text-center w-100 my-3">
                    <button type="submit" class="btn btn-primary mx-1 share">@lang('gadwalls.save')</button>
                </div>
            </div>
        </form>
    </div>

    <script src="{{ asset('js/setting.js') }}"></script>

    <script>
        // Initialize Quagga
        Quagga.init({
            inputStream: {
                name: "Live",
                type: "LiveStream",
                target: document.querySelector('#interactive'), // video element
            },
            decoder: {
                readers: ["code_128_reader"] // Specify the barcode type you want to scan
            }
        }, (err) => {
            if (err) {
                console.error(err);
                return;
            }
            Quagga.start();
        });

        // Event listener for detected codes
        Quagga.onDetected((data) => {
            const barcode = data.codeResult.code;
            document.getElementById('barcode').value = barcode;
            console.log("Detected barcode: ", barcode);
            // Stop scanning after successful detection (optional)
            Quagga.stop();
        });

        // Handle form submission
        document.getElementById('upload-form').addEventListener('submit', (event) => {
            event.preventDefault(); // Prevent the default form submission

            const fileInput = document.getElementById('files');
            const files = fileInput.files; // Get the selected files
            const errorMessage = document.getElementById('file-error');

            // Check if the number of selected files exceeds 7
            if (files.length > 7) {
                errorMessage.textContent = 'يرجى اختيار 7 ملفات كحد أقصى.';
                errorMessage.style.display = 'block';
                return; // Exit the function
            } else {
                errorMessage.style.display = 'none'; // Hide the error message
            }

            // Create FormData object and submit the form via AJAX
            const formData = new FormData(event.target);

            $.ajax({
                url: "{{ route('product.store') }}", // Change this to your route
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    alert('تم رفع البيانات بنجاح!');
                },
                error: function(xhr) {
                    alert('حدث خطأ أثناء رفع البيانات!');
                }
            });
        });
    </script>
@endsection
