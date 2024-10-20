<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simplified Tax Invoice</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            direction: rtl;
        }

        .invoice-container {
            width: 70%;
            max-width: 800px;
            background-color: white;
            margin: 20px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 2px solid #ccc;
            border-radius: 8px;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
            text-align: center;
        }

        .logo img {
            width: 130px;
            margin: 15px;
        }

        .invoice-details {
            margin: 0 20px;
            flex-grow: 1;
        }

        .invoice-details h2 {
            margin: 0;
            margin-top: 20px;
            font-size: 24px;
        }

        .invoice-details p {
            margin: 5px 0;
        }

        .qr-code img {
            width: 120px;
            margin: 15px;
        }

        .invoice-info {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: flex-start;
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            text-align: center;
        }

        .invoice-info p {
            margin: 0;
            padding: 5px;
            font-size: 14px;
        }

        .invoice-section {
            display: flex;
            justify-content: space-between;
            width: 100%;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
            text-align: center;
        }

        .invoice-section h4 {
            width: 100%;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            font-size: 12px;
        }

        .invoice-table th {
            background-color: #f0f0f0;
        }

        .summary {
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: right;
            margin-top: 20px;
            font-size: 14px;
            padding: 10px;
            border: 1px solid #ddd;
        }

        .summary p {
            margin: 0;
            padding: 0;
        }

        .summary .total {
            font-size: 18px;
            font-weight: bold;
        }

        .signatures {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }

        .signature-box img {
            width: 120px;
            margin-top: 10px;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .invoice-container {
                width: 90%;
                padding: 10px;
            }

            .invoice-header {
                flex-direction: row;
                justify-content: space-between;
                flex-wrap: nowrap;
            }

            .logo img,
            .qr-code img {
                width: 80px;
                margin: 5px;
            }

            .invoice-details h2 {
                font-size: 20px;
            }

            .invoice-info p,
            .summary p {
                font-size: 12px;
            }

            .invoice-table th,
            .invoice-table td {
                font-size: 10px;
                padding: 5px;
            }

            .summary {
                font-size: 12px;
                padding: 5px;
            }

            .signature-box img {
                width: 80px;
            }
        }

        /* Print Styles */
        @media print {
            body {
                background-color: white;
                width: 100%;
            }

            .invoice-container {
                box-shadow: none;
                border: none;
                width: 100%;
                padding: 10px;
                margin: 0;
                page-break-inside: avoid;
            }

            .invoice-header {
                justify-content: space-between;
                align-items: center;
                padding: 0;
                border: none;
            }

            .invoice-header,
            .invoice-info,
            .invoice-section,
            .summary,
            .signatures {
                font-size: 10px;
            }

            .invoice-table th,
            .invoice-table td {
                font-size: 8px;
                padding: 5px;
            }

            .summary .total {
                font-size: 14px;
            }

            .signatures {
                margin-top: 20px;
            }

            .signature-box img {
                width: 60px;
            }
        }

        /* Footer styles */
        .footer {
            margin-top: 40px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #555;
        }

        .footer .company-details {
            margin-bottom: 10px;
        }

        .footer .company-details p {
            margin: 2px 0;
        }

        .footer .social-media {
            margin-top: 10px;
        }

        .footer .social-media a {
            margin: 0 5px;
            text-decoration: none;
            color: #555;
            font-size: 14px;
        }

        .footer .social-media a:hover {
            color: #000;
        }

        .fancy-header {
            font-size: 64px;
            font-weight: bold;
            color: rgba(0, 0, 0, 0.5);
            transform: rotate(-5deg);
            text-align: center;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
        }
    </style>
</head>


<body>
    <div class="invoice-container">
        <header class="invoice-header">
            <div class="logo">
                <img src="data:image/svg+xml;base64,{{ base64_encode(file_get_contents(public_path('images/img/logo.svg'))) }}"
                    alt="Gadawel logo">
            </div>
            <div class="invoice-details">
                <h2>@lang('gadwalls.invoice_title')</h2>
                <p>@lang('gadwalls.company_name') (Branch Nseeb)</p>
                <p>@lang('gadwalls.invoice_number'): 212222</p>
            </div>
            <div class="qr-code">
                @if (!empty($qrCode))
                    <p class="student-info">
                        <img src="{{ $qrCode }}" alt="QR Code" class="qr-code"><br>@lang('gadwalls.scan_qr')
                    </p>
                @else
                    <p class="student-info">
                        <img src="{{ asset('images/img/qrcode.svg') }}" alt="Gadawel logo">
                    </p>
                @endif
            </div>
        </header>

        <div class="invoice-info">
            <p>@lang('gadwalls.due_date'): <span>{{ now()->format('Y/m/d') }}</span></p>
            <p>@lang('gadwalls.issue_date'): <span>{{ now()->format('Y/m/d') }}</span></p>
            <p>@lang('gadwalls.status'): <span>@lang('gadwalls.paid')</span></p>
            <p>Purchase Origin: <span>Online</span></p>
        </div>

        <div class="invoice-section">
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th colspan="2"> @lang('gadwalls.invoice_from')</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>@lang('gadwalls.supplier'):</td>
                        <td><span>Dalal Al-Barakah Company</span></td>
                    </tr>
                    <tr>
                        <td>@lang('gadwalls.creator'):</td>
                        <td><span>{{ auth()->user()->name }}</span></td>
                    </tr>
                    <tr>
                        <td>@lang('gadwalls.role'):</td>
                        <td><span> {{ auth()->user()->getRoleName() }}</span></td>
                    </tr>
                    <tr>
                        <td>@lang('gadwalls.commercial_registration'):</td>
                        <td><span>{{ auth()->user()->commercial }}</span></td>
                    </tr>
                    <tr>
                        <td>@lang('gadwalls.vat_number'):</td>
                        <td><span>234233334234234</span></td>
                    </tr>
                    <tr>
                        <td>@lang('gadwalls.phone_number'):</td>
                        <td><span>{{ auth()->user()->phone }}</span></td>
                    </tr>
                </tbody>
            </table>

            <table class="invoice-table">
                <thead>
                    <tr>
                        <th colspan="2"> @lang('gadwalls.bill_to')</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>@lang('gadwalls.commercial_registration'):</td>
                        <td><span>1200000295</span></td>
                    </tr>
                    <tr>
                        <td>@lang('gadwalls.client'):</td>
                        <td><span>Virtual Client</span></td>
                    </tr>
                    <tr>
                        <td>@lang('gadwalls.vat_number'):</td>
                        <td><span>234233334234234</span></td>
                    </tr>
                    <tr>
                        <td>@lang('gadwalls.address'):</td>
                        <td><span>Default Address</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <table class="invoice-table" id="ordersTable">
            <thead>
                <tr>
                    <th>@lang('gadwalls.num')</th>
                    <th>@lang('gadwalls.item')</th>
                    <th>@lang('gadwalls.quantity')</th>
                    <th>@lang('gadwalls.unit_price')</th>
                    <th>@lang('gadwalls.rival')</th>
                    <th>@lang('gadwalls.taxAmount')</th>
                    <th>@lang('gadwalls.discount')</th>
                    <th>@lang('gadwalls.total_price_tax')</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <div class="summary">
            <p>@lang('gadwalls.total_amount'): <span id="totalAmount">0.00</span></p>
            <p>@lang('gadwalls.tax_amount'): <span id="taxAmount">0.00</span></p>
            <p>@lang('gadwalls.rivalAmount'): <span id="rivalAmount">0.00</span></p>
            <p class="total">@lang('gadwalls.total_tax'): <span id="totalWithTax">0.00</span></p>
        </div>

        <div class="signatures">
            <div class="signature-box">
                <p>@lang('gadwalls.signature_supplier')</p>
                <img src="images/img/test.png" alt="Signature">
            </div>
            <h1 class="fancy-header">Gadawlls</h1>
            <div class="signature-box">
                <p>@lang('gadwalls.signature_client')</p>
                <img src="images/img/test2.png" alt="Signature">
            </div>
        </div>
        <div class="footer">
            <div class="company-details">
                <p>@lang('gadwalls.company_name')</p>
                <p>@lang('gadwalls.footer_contact'):</p>
                <p>Phone: 5002121212</p>
                <p>Email: contact@gadawel.com</p>
            </div>
            <div class="social-media">
                <a href="#">Facebook</a>
                <a href="#">Twitter</a>
                <a href="#">Instagram</a>
            </div>
        </div>
        <div class="buttons">
            <button id="printInvoice" class="print-button">@lang('gadwalls.print_invoice')</button>
        </div>
    </div>
    <script>
        document.getElementById('printInvoice').addEventListener('click', function() {
            this.classList.add('hidden');
            window.print();
            this.classList.remove('hidden');
        });

        window.onload = function() {
            const ordersData = localStorage.getItem('orders');

            if (ordersData) {
                const orders = JSON.parse(ordersData);

                const ordersTableBody = document.querySelector('#ordersTable tbody');
                let total = 0; // Initialize total
                let tax = 0; // Initialize tax
                let rival = 0; // Initialize rival
                let price = 0; // Initialize price
                let totalWithTax = 0; // Initialize totalWithTax

                orders.forEach((order, index) => {
                    const row = document.createElement('tr');

                    // Use parseFloat to ensure you're adding numbers
                    const orderTotal = parseFloat(order.total) || 0;
                    const orderTax = parseFloat(order.tax) || 0;
                    const orderPrice = parseFloat(order.price) || 0;
                    const orderRival = parseFloat(order.rival) || 0;
                    const orderQuantity = parseFloat(order.quantity) || 0;

                    total += orderTotal;
                    tax += orderTax;
                    price += orderPrice;
                    rival += orderRival * orderQuantity; // Calculate rival based on quantity

                    row.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${order.name}</td>
                        <td>${orderQuantity}</td>
                        <td>${orderPrice.toFixed(2)}</td>
                        <td>${(orderRival * orderQuantity).toFixed(2)}%</td>
                        <td>${orderTax.toFixed(2)}</td>
                        <td>${order.selected_option_name}</td>
                        <td>${orderTotal.toFixed(2)}</td>
                    `;
                    ordersTableBody.appendChild(row);
                });

                totalWithTax = total + tax;

                // Update the elements with the calculated values
                document.getElementById('totalAmount').innerText = total.toFixed(2);
                document.getElementById('taxAmount').innerText = tax.toFixed(2);
                document.getElementById('rivalAmount').innerText = rival.toFixed(2);
                document.getElementById('totalWithTax').innerText = totalWithTax.toFixed(2);

                localStorage.removeItem('orders');
            }
        };
    </script>



</body>


</html>
