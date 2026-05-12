<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->id }}</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        /* Invoice Container */
        #invoice-card {
            background: #fff;
            max-width: 850px;
            margin: 20px auto;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Header Section */
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .brand-section h2 {
            margin: 0;
            color: #2563eb;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .invoice-label h1 {
            margin: 0;
            font-size: 24px;
            color: #111827;
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        .info-box h6 {
            margin: 0 0 8px 0;
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
        }

        .info-box p {
            margin: 0;
            line-height: 1.5;
            font-size: 14px;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        thead {
            background-color: #f9fafb;
        }

        th {
            text-align: left;
            padding: 12px 15px;
            font-size: 13px;
            color: #4b5563;
            border-bottom: 1px solid #e5e7eb;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #f3f4f6;
            font-size: 14px;
        }

        .product-name {
            font-weight: 600;
            color: #111827;
        }

        /* Totals Section */
        .totals-area {
            display: flex;
            justify-content: flex-end;
        }

        .totals-table {
            width: 250px;
        }

        .totals-table tr td {
            padding: 8px 0;
            border: none;
        }

        .grand-total {
            font-size: 18px;
            font-weight: 700;
            color: #2563eb;
            border-top: 2px solid #f0f0f0 !important;
            padding-top: 15px !important;
        }

        /* Controls */
        .controls {
            text-align: center;
            margin-top: 30px;
        }

        .btn-download {
            background: #2563eb;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-download:hover {
            background: #1d4ed8;
        }

        .redirect-notice {
            margin-top: 15px;
            font-size: 13px;
            color: #9ca3af;
        }
    </style>
</head>
<body>

<div id="invoice-card">
    <div class="invoice-header">
        <div class="brand-section">
            <h2>ENVATO MARKET</h2>
        </div>
        <div class="invoice-label">
            <h1>INVOICE</h1>
            <p style="margin:0; text-align: right; color: #6b7280;">#{{ $order->id }}</p>
        </div>
    </div>

    <div class="info-grid">
        <div class="info-box">
            <h6>Bill From:</h6>
            <p><strong>Envato Market</strong><br>
            123 Business Avenue<br>
            City, Country 56789</p>
        </div>
        <div class="info-box" style="text-align: right;">
            <h6>Bill To:</h6>
            <p><strong>{{ $order->user_rel->name }}</strong><br>
            {{ $order->user_rel->email }}<br>
            {{ $order->order_address ?? 'Address N/A' }}</p>
        </div>
    </div>

    <div class="info-grid">
        <div class="info-box">
            <h6>Order Date:</h6>
            <p>{{ $order->created_at->format('d F Y') }}</p>
        </div>
        <div class="info-box" style="text-align: right;">
            <h6>Status:</h6>
            <p><span style="background: #dcfce7; color: #166534; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">{{ strtoupper($order->status) }}</span></p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>PRODUCT</th>
                <th style="text-align: center;">QTY</th>
                <th style="text-align: right;">PRICE</th>
                <th style="text-align: right;">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderDetails_rel as $item)
            <tr>
                <td class="product-name">{{ $item->variant->product->product_name ?? 'Product' }}</td>
                <td style="text-align: center;">{{ $item->order_quantity }}</td>
                <td style="text-align: right;">₹{{ number_format($item->price_per_unit, 2) }}</td>
                <td style="text-align: right;">₹{{ number_format($item->order_quantity * $item->price_per_unit, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals-area">
        <table class="totals-table">
            <tr>
                <td style="color: #6b7280;">Subtotal</td>
                <td style="text-align: right;">₹{{ number_format($order->final_amount, 2) }}</td>
            </tr>
            <tr>
                <td class="grand-total">Grand Total</td>
                <td class="grand-total" style="text-align: right;">₹{{ number_format($order->final_amount, 2) }}</td>
            </tr>
        </table>
    </div>
</div>

<div class="controls">
    <button class="btn-download" onclick="downloadInvoice()">Download PDF Invoice</button>
    <p class="redirect-notice">You will be redirected to your orders page in <span id="timer">7</span> seconds...</p>
</div>

<script>
    function downloadInvoice() {
        const element = document.getElementById('invoice-card');
        const opt = {
            margin:       0.5,
            filename:     'Invoice_{{ $order->id }}.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
        };
        html2pdf().set(opt).from(element).save();
    }

    // Countdown Timer UI
    let timeLeft = 7;
    const timerElement = document.getElementById('timer');
    setInterval(() => {
        timeLeft--;
        if(timeLeft >= 0) timerElement.innerText = timeLeft;
    }, 1000);

    // Auto Redirect
    setTimeout(() => {
        window.location.href = "{{ route('user.order.page') }}";
    }, 100000);
</script>

</body>
</html>
