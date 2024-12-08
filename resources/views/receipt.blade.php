<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            max-width: 300px;
            margin: 0 auto;
            padding: 10px;
            background-color: #f4f4f4;
        }

        .receipt-container {
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 14px;
        }

        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .receipt-header h2 {
            margin: 0;
            color: #007bff;
        }

        .receipt-header p {
            margin: 5px 0;
        }

        .receipt-details p {
            margin: 3px 0;
        }

        .receipt-items {
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .receipt-items .item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .receipt-items .item span {
            width: 60%;
        }

        .receipt-items .item .price {
            width: 40%;
            text-align: right;
        }

        .receipt-total {
            font-weight: bold;
            text-align: right;
            margin-top: 10px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #555;
        }

        .footer p {
            margin: 3px 0;
        }
    </style>
</head>

<body>
    <div class="receipt-container">
        <div class="receipt-header">
            <h2>Struk Pembayaran</h2>
            <p>{{ config('app.name', 'Nama Perusahaan') }}</p>
            <p>Tanggal: {{ $invoice->order_date }}</p>
            <p>Kode Invoice: {{ $invoice->invoice_code }}</p>
        </div>

        <div class="receipt-details">
            <p><strong>Nama Penerima:</strong> {{ $invoice->recipient_name }}</p>
            <p><strong>No. Telepon:</strong> {{ $invoice->recipient_phone }}</p>
            <p><strong>Alamat:</strong> {{ $invoice->recipient_address }}</p>
        </div>

        <div class="receipt-items">
            @foreach ($invoice->details as $detail)
                <div class="item">
                    <span>
                        @php
                            $itemName = '';
                            if (!empty($detail->product_name)) {
                                $itemName = 'Produk: ' . $detail->product_name;
                            } elseif (!empty($detail->treatment_name)) {
                                $itemName = 'Perawatan: ' . $detail->treatment_name;
                            } elseif (!empty($detail->course_name)) {
                                $itemName = 'Kursus: ' . $detail->course_name;
                            }
                        @endphp
                        {{ $itemName }}
                    </span>
                    <span class="price">{{ number_format($detail->subtotal, 2, ',', '.') }}</span>
                </div>
            @endforeach
        </div>

        <div class="receipt-total">
            <p>Total: {{ number_format($invoice->details->sum('subtotal'), 2, ',', '.') }}</p>
        </div>

        <div class="footer">
            <p>Terima kasih atas pembelian Anda!</p>
            <p>Silakan hubungi kami jika ada pertanyaan.</p>
        </div>
    </div>
</body>

</html>
