<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $invoice->invoice_code }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .invoice-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .company-info h1 {
            margin: 0;
            color: #007bff;
        }

        .invoice-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .invoice-details-section {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
        }

        .invoice-details-section h3 {
            margin-top: 0;
            color: #007bff;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .invoice-table th {
            background-color: #007bff;
            color: white;
            padding: 10px;
            text-align: left;
        }

        .invoice-table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .invoice-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .total {
            font-weight: bold;
            font-size: 1.2em;
            color: #007bff;
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <div class="company-info">
                <h1>Invoice</h1>
                <p>{{ config('app.name', 'Your Company Name') }}</p>
            </div>
            <div>
                <strong>Invoice Code:</strong> {{ $invoice->invoice_code }}<br>
                <strong>Date:</strong> {{ $invoice->order_date }}
            </div>
        </div>

        <div class="invoice-details">
            <div class="invoice-details-section">
                <h3>Customer Information</h3>
                <p><strong>Recipient Name:</strong> {{ $invoice->recipient_name }}</p>
                <p><strong>Phone:</strong> {{ $invoice->recipient_phone }}</p>
                <p><strong>Address:</strong> {{ $invoice->recipient_address }}</p>
                @if (!empty($invoice->recipient_bank))
                    <p><strong>Bank:</strong> {{ $invoice->recipient_bank }}</p>
                @endif
            </div>
            <div class="invoice-details-section">
                <h3>Order Details</h3>
                <p><strong>Order Date:</strong> {{ $invoice->order_date }}</p>
                <p><strong>Order Status:</strong> {{ $invoice->order_status }}</p>
                @if (!empty($invoice->order_complete))
                    <p><strong>Completed:</strong> {{ $invoice->order_complete }}</p>
                @endif
                @if (!empty($invoice->recipient_request))
                    <p><strong>Special Requests:</strong> {{ $invoice->recipient_request }}</p>
                @endif
            </div>
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->details as $detail)
                    <tr>
                        <td>
                            @php
                                $itemName = '';
                                if (!empty($detail->product_name)) {
                                    $itemName = 'Product: ' . $detail->product_name;
                                } elseif (!empty($detail->treatment_name)) {
                                    $itemName = 'Treatment: ' . $detail->treatment_name;
                                } elseif (!empty($detail->course_name)) {
                                    $itemName = 'Course: ' . $detail->course_name;
                                }
                            @endphp
                            {{ $itemName }}
                        </td>
                        <td>{{ number_format($detail->price, 2, ',', '.') }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ number_format($detail->subtotal, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            Total: {{ number_format($invoice->details->sum('subtotal'), 2, ',', '.') }}
        </div>
    </div>
</body>

</html>
