@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/add-product.css') }}">


    <div class="container form-container">
        <h2 class="text-center mb-3" id="title">@lang('gadwalls.text-top')</h2>
        <form action="#" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row mb-4">
                <div class="d-flex flex-wrap w-100 justify-content-between">

                    <!-- name -->
                    <div class="col-md-5 mb-2 custom-input-spacing">
                        <x-add-row :name="'name'" :type="'text'" :error="'name'" />
                    </div>

                    <!-- suppliers -->
                    <div class="col-md-5 mb-2 custom-input-spacing">
                        <x-select :name="'supplier_id'" :error="'supplier_id'" />
                    </div>

                    <!-- quantity -->
                    <div class="col-md-5 mb-2 custom-input-spacing">
                        <x-add-row :name="'quantity'" :type="'number'" :error="'quantity'" />
                    </div>

                    <!-- expire_date -->
                    <div class="col-md-5 mb-2 custom-input-spacing">
                        <x-add-row :name="'expire_date'" :type="'date'" :error="'expire_date'" />
                    </div>

                    <!-- name -->
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
                            <x-add-row :name="'code'" :type="'text'" :error="'code'" />
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



    <script src="{{ asset('js/add-book.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>

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
        document.getElementById('submit').addEventListener('click', () => {
            const barcode = document.getElementById('barcode').value;
            // Send barcode to the server
            fetch('/your-barcode-route', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        barcode
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        });
    </script>
@endsection
