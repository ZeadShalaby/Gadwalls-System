@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/add-product.css') }}">
    <link rel="stylesheet" href="{{ asset('css/salebillmenu.css') }}">

    <div class="container form-container">
        <h2 class="text-center mb-3" id="title">@lang('kotaby.text-top')</h2>
        <form id="myForm" action="{{ route('salebill.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row mb-4">
                <div class="d-flex flex-wrap w-100 justify-content-between">

                    <!-- Scan Code -->
                    <div class="col-md-5 mb-2 custom-input-spacing">
                        <label for="code" class="form-label text-right d-block">@lang('kotaby.code')</label>
                        <div class="d-flex align-items-center">
                            <button type="button" id="start-scan" class="barcode-btn">
                                <img src="{{ asset('images/img/scan.png') }}" alt="barcode" />
                            </button>
                            <x-add-row :name="'code'" :type="'text'" :error="'code'" id="barcode" />
                        </div>
                    </div>

                    <!-- Name -->
                    <div class="col-md-5 mb-2 custom-input-spacing">
                        <x-add-row :name="'name'" :type="'text'" :error="'name'" />
                    </div>

                    <!-- Quantity -->
                    <div class="col-md-5 mb-2 custom-input-spacing">
                        <x-add-row :name="'quantity'" :type="'text'" :error="'quantity'" />
                    </div>

                    <!-- Price -->
                    <div class="col-md-5 mb-2 custom-input-spacing">
                        <x-add-row :name="'price'" :type="'number'" :error="'price'" />
                    </div>

                    <!-- Store ID -->
                    <div class="col-md-5 mb-2 custom-input-spacing">
                        <x-add-row :name="'store_id'" :id="'store_id'" :type="'hidden'" :error="'store_id'" />
                        <input type="text" id="store_name" class="form-control" placeholder="@lang('gadwalls.store_name')" value
                            value="{{ old('store_name') }}" readonly />
                    </div>

                    <!-- Supplier ID -->
                    <div class="col-md-5 mb-2 custom-input-spacing">
                        <x-add-row :name="'supplier_id'" :id="'supplier_id'" :type="'hidden'" :error="'supplier_id'" />
                        <input type="text" id="supplier_name" class="form-control" placeholder="@lang('gadwalls.supplier_name')"
                            value="{{ old('supplier_name') }}" readonly />
                    </div>


                    <!-- Dropdown Menu -->
                    <div class="col-md-5 mb-2 custom-input-spacing">
                        <label for="dropdown" class="form-label text-right d-block">@lang('gadwalls.select_option')</label>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                @lang('gadwalls.select_option')
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="#" data-value="3">@lang('gadwalls.after_tax')</a></li>
                                <li><a class="dropdown-item" href="#" data-value="4">@lang('gadwalls.before_tax') </a></li>
                                <li><a class="dropdown-item" href="#" data-value="5">@lang('gadwalls.wow') </a></li>
                                <li><a class="dropdown-item" href="#" data-value="6">@lang('gadwalls.frw') </a></li>
                            </ul>
                        </div>
                        <input type="hidden" id="selected_option" name="selected_option" />
                    </div>

                    <!--- total --->
                    <div id="dynamic-input" class="col-md-5 mb-2 custom-input-spacing">
                        <x-add-row :name="'total'" :type="'text'" :error="'total'" />
                    </div>


                    <!--  Rival -->
                    <div class="col-md-5 mb-2 custom-input-spacing">
                        <input type="hidden" id="rival" class="form-control" type="hidden" name="rival"
                            placeholder="@lang('gadwalls.supplier_name')" readonly />
                    </div>

                </div>
            </div>

            <div class="row mb-4">
                <div class="d-flex flex-wrap w-100 justify-content-center">

                    <!-- Checkbox 1 -->
                    <div class="col-md-4 mb-2 custom-input-spacing text-center">
                        <div class="form-check d-flex align-items-center justify-content-center">
                            <input class="form-check-input me-2" type="checkbox" id="checkbox1" name="tax_option"
                                value="1">
                            <label class="form-check-label" for="checkbox1">
                                @lang('gadwalls.tax_included')
                            </label>
                        </div>
                    </div>

                    <!-- Checkbox 2 -->
                    <div class="col-md-4 mb-2 custom-input-spacing text-center">
                        <div class="form-check d-flex align-items-center justify-content-center">
                            <input class="form-check-input me-2" type="checkbox" id="checkbox2" name="tax_option"
                                value="2">
                            <label class="form-check-label" for="checkbox2">
                                @lang('gadwalls.tax_excluded')
                            </label>
                        </div>
                    </div>

                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-bordered mt-4" id="orderTable">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <div class="text-center w-100 my-3">
                <button id="submitButton" type="submit" class="btn btn-primary mx-1 share">@lang('gadwalls.create')</button>
                <button id="save" class="btn btn-primary mx-1 share">@lang('gadwalls.save')</button>
            </div>
        </form>
    </div>

    <!-- Scanner Container (hidden) -->
    <div id="scanner-container"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 1000;">
        <div id="scanner" style="width: 100%; height: 100%;"></div>
    </div>

    <script src="{{ asset('js/add-book.js') }}"></script>

    <!--- scan barcode --->
    <script>
        document.getElementById('start-scan').addEventListener('click', function() {
            document.getElementById('scanner-container').style.display = 'block';

            Quagga.init({
                inputStream: {
                    name: "Live",
                    type: "LiveStream",
                    target: document.querySelector('#scanner')
                },
                decoder: {
                    readers: ["code_128_reader"]
                }
            }, function(err) {
                if (err) {
                    console.log(err);
                    return;
                }
                console.log("Initialization finished. Ready to start");
                Quagga.start();
            });

            Quagga.onDetected(function(result) {
                var code = result.codeResult.code;
                document.getElementById('barcode').value = code;
                Quagga.stop();
                document.getElementById('scanner-container').style.display = 'none';
            });
        });
    </script>
    <!--- product details based on barcode --->
    <script>
        // Fetch product details based on barcode
        document.getElementById('code').addEventListener('change', function() {
            let productCode = this.value;
            document.getElementById('total').value = "";

            fetch(`/api/invoice/${productCode}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);

                    document.getElementById('name').value = data.product_name;
                    document.getElementById('quantity').value = (data.quantity === 0) ? 0 : 1;
                    document.getElementById('price').value = data.price;
                    document.getElementById('store_id').value = data.store.id;
                    document.getElementById('store_name').value = data.store.name;
                    document.getElementById('supplier_id').value = data.supplier.id;
                    document.getElementById('supplier_name').value = data.supplier.name;
                    document.getElementById('rival').value = data.rival.rival;

                })
                .catch(error => console.error('Error:', error));
        });


        // Update dropdown menu based on selected option
        document.querySelectorAll('.dropdown-item').forEach(item => {
            item.addEventListener('click', function() {
                const selectedText = this.textContent;
                const selectedValue = this.getAttribute('data-value');
                document.getElementById('dropdownMenuButton').innerText = selectedText;
                document.getElementById('selected_option').value = selectedValue; // حفظ القيمة في حقل مخفي
            });
        });

        // Calculate price based on quantity
        document.getElementById('quantity').addEventListener('change', function() {
            let productQuantity = parseFloat(this.value);
            let productPrice = parseFloat(document.getElementById('price').value);

            if (!isNaN(productQuantity) && !isNaN(productPrice)) {
                document.getElementById('price').value = (productQuantity * productPrice).toFixed(2);
            }
        });
    </script>
    <!--- total price --->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dynamicInput = document.getElementById('total');
            const form = document.getElementById('myForm');

            if (!form) {
                console.error("Form not found!");
                return;
            }

            document.querySelectorAll('.dropdown-item').forEach(item => {
                item.addEventListener('click', function() {
                    const selectedValue = this.getAttribute('data-value');

                    const formData = new FormData(form);

                    fetch(`/salebill/calculate/price`, {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);

                            if (data.calculated_price) {
                                dynamicInput.value = data
                                    .calculated_price;
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
    <!---  add list of orders and create fatoorah and edit and delete it  --->
    <script>
        let quantity;
        const orderList = [];

        document.getElementById('save').addEventListener('click', function(event) {
            event.preventDefault();

            const productCode = document.getElementById('code').value;

            fetch(`/api/invoice/${productCode}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    quantity = data.quantity;
                    console.log("quantity: ", quantity);

                    // Call handleOrder with the productCode and quantity after the fetch completes
                    handleOrder(productCode, quantity);
                })
                .catch(error => {
                    console.error('Error fetching product data:', error);
                });
        });

        function handleOrder(productCode, quantity) { // Accept productCode as a parameter
            const quantityClient = document.getElementById('quantity').value;

            if (quantityClient <= 0) {
                alert('not valid quantity it should be greater than 0');
                return;
            }

            if (quantityClient > quantity) {
                alert(`quantity must be less than or equal to (${quantity}).`);
                document.getElementById('quantity').value = quantity;
                return;
            }

            const form = document.getElementById('myForm');
            const orderData = {};
            const formData = new FormData(form);

            formData.forEach((value, key) => {
                orderData[key] = value;
            });

            orderData.total = orderData.total !== undefined && orderData.total !== null && orderData.total !== "" ?
                orderData.total :
                orderData.price;

            orderList.push(orderData);
            updateOrderTable(orderData, orderList.length - 1);
        }

        function updateOrderTable(orderData, index) {
            const tableBody = document.querySelector('#orderTable tbody');
            const row = document.createElement('tr');

            row.innerHTML = `
            <td>${orderData.code}</td>
            <td>${orderData.name}</td>
            <td>${orderData.quantity}</td>
            <td>${orderData.price}</td>
            <td>${orderData.total}</td>
            <td>
                <button class="edit-btn" data-index="${index}"><i class="fas fa fa-edit"></i></button>
                <button class="delete-btn" data-index="${index}"><i class="fas fa fa-trash"></i></button>
            </td>
        `;

            tableBody.appendChild(row);

            row.querySelector('.edit-btn').addEventListener('click', editOrder);
            row.querySelector('.delete-btn').addEventListener('click', deleteOrder);
        }

        // Function to handle editing an order
        function editOrder(event) {
            const index = event.currentTarget.getAttribute('data-index');
            const orderData = orderList[index];

            // Replace table cells with input fields for editing
            const tableRow = event.currentTarget.closest('tr'); // Get the closest table row

            tableRow.innerHTML = `
                <td><input type="text" value="${orderData.code}" data-field="code" /></td>
                <td><input type="text" value="${orderData.name}" data-field="name" /></td>
                <td><input type="number" value="${orderData.quantity}" data-field="quantity" class="quantity" /></td>
                <td><input type="number" value="${orderData.price}" data-field="price" class="price" /></td>
                <td><input type="number" value="${orderData.total}" data-field="total" readonly /></td>
                <td>
                <button class="save-btn" data-index="${index}" title="Save"><i class="fas fa-check"></i></button>
                <button class="cancel-btn" data-index="${index}" title="Cancel"><i class="fas fa-times"></i></button>
                </td>
            `;

            // Add event listeners for Save and Cancel buttons
            tableRow.querySelector('.save-btn').addEventListener('click', saveOrder);
            tableRow.querySelector('.cancel-btn').addEventListener('click', () => {
                renderOrderTable(); // Cancel and re-render the table
            });

            // Add event listeners for quantity and price input changes
            tableRow.querySelector('.quantity').addEventListener('input', () => {
                updateNewPriceTotal(tableRow, orderData);
            });
            tableRow.querySelector('.price').addEventListener('input', () => {
                updateNewPriceTotal(tableRow, orderData);
            });
        }

        // Function to update the total based on new quantity and price
        function updateNewPriceTotal(tableRow, orderData) {
            const originalQuantity = parseFloat(orderData.quantity);
            const originalPrice = parseFloat(orderData.price);
            const originalTotal = parseFloat(orderData.total);
            const newQuantity = parseFloat(tableRow.querySelector('.quantity').value) || 0;

            // Calculate new price and total
            const newPrice = (originalPrice / originalQuantity) * newQuantity;
            const newTotal = (originalTotal / originalQuantity) * newQuantity;

            // Update input fields
            tableRow.querySelector('input[data-field="price"]').value = newPrice.toFixed(2);
            tableRow.querySelector('input[data-field="total"]').value = newTotal.toFixed(2);
        }

        // Function to handle saving edited order
        function saveOrder(event) {
            const index = event.currentTarget.getAttribute('data-index');
            const tableRow = event.currentTarget.closest('tr');

            const updatedOrderData = {
                code: tableRow.querySelector('input[data-field="code"]').value,
                name: tableRow.querySelector('input[data-field="name"]').value,
                quantity: tableRow.querySelector('input[data-field="quantity"]').value,
                price: tableRow.querySelector('input[data-field="price"]').value,
                total: tableRow.querySelector('input[data-field="total"]').value,
            };

            if (parseInt(updatedOrderData.quantity) > quantity) {
                alert(`quantity must be less than or equal to(${quantity}).`);
                updatedOrderData.quantity = quantity;
            }

            orderList[index] = updatedOrderData;

            renderOrderTable();
        }

        // Function to handle deleting an order
        function deleteOrder(event) {
            const index = event.currentTarget.getAttribute('data-index'); // Correctly reference the index

            // Remove the order from the orderList array
            orderList.splice(index, 1);

            // Re-render the table to reflect the deletion
            renderOrderTable();
        }

        // Function to re-render the order table after any changes
        function renderOrderTable() {
            const tableBody = document.querySelector('#orderTable tbody');
            tableBody.innerHTML = ''; // Clear the current table

            // Re-render each order in the orderList
            orderList.forEach((orderData, index) => {
                updateOrderTable(orderData, index);
            });
        }

        // Send data to the API and handle submission
        $(document).ready(function() {
            $('#submitButton').click(function(event) {
                event.preventDefault(); // Prevent default form submission

                const formData = $('#myForm').serializeArray(); // Serialize form data
                console.log(orderList);

                // Convert the orderList array to JSON and append it to formData
                formData.push({
                    name: 'orderList',
                    value: JSON.stringify(
                        orderList), // Convert orderList to JSON for backend processing
                });

                // Log form data to the console for debugging
                console.log(orderList);

                // Submit the form to the API (replace with actual API call)
                $.ajax({
                    url: '/salebill/store', // Replace with your API endpoint
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log('Form submitted successfully:', response);
                        localStorage.setItem('orders', JSON.stringify(response.data.orders));

                        window.location.href = response.redirectUrl;
                    },
                    error: function(xhr, status, error) {
                        console.log('Form submission error:', error);
                    }
                });
            });
        });
    </script>
@endsection
