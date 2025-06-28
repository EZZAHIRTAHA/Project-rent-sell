<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vente Invoice</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />
    <style>
        @media print {
            @page {
                size: A3;
            }
        }

        ul {
            padding: 0;
            margin: 0 0 1rem 0;
            list-style: none;
        }

        body {
            font-family: "Inter", sans-serif;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        table th,
        table td {
            border: 1px solid silver;
        }

        table th,
        table td {
            text-align: right;
            padding: 8px;
        }

        h1,
        h4,
        p {
            margin: 0;
        }

        .container {
            padding: 20px 0;
            width: 1000px;
            max-width: 90%;
            margin: 0 auto;
        }

        .inv-title {
            padding: 10px;
            border: 1px solid silver;
            text-align: center;
            margin-bottom: 30px;
        }

        .inv-logo {
            width: 150px;
            display: block;
            margin: 0 auto;
            margin-bottom: 40px;
        }

        .inv-header {
            display: flex;
            margin-bottom: 20px;
        }

        .inv-header> :nth-child(1) {
            flex: 2;
        }

        .inv-header> :nth-child(2) {
            flex: 1;
        }

        .inv-header h2 {
            font-size: 20px;
            margin-bottom: 0.5rem;
        }

        .inv-header ul li {
            font-size: 15px;
            padding: 3px 0;
        }

        .inv-body table th,
        .inv-body table td {
            text-align: left;
        }

        .inv-body {
            margin-bottom: 30px;
        }

        .inv-footer {
            display: flex;
        }

        .inv-footer> :nth-child(1) {
            flex: 2;
        }

        .inv-footer> :nth-child(2) {
            flex: 1;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="inv-title">
            <h1>Invoice # {{ now()->format('Ymd') }}-{{ $vente->id }}</h1>
        </div>

        <p style="margin-bottom: 30px; font-weight: bold">
            Thank you for your purchase. You can present this invoice in-store to collect your car.
        </p>

        <div class="inv-header">
            <div>
                <h2 style="color: #ff9b00">Rent & Sell Car</h2>
                <ul>
                    <li>DR Soulaimane elhourre</li>
                    <li>Kenitra</li>
                    <li>+212617xxxxxxx | contact.mouad_TAKHDOUKHI@gmail.com</li>
                </ul>

                <h2>Client</h2>
                <ul>
                    <li>{{ $vente->user->name }}</li>
                    <li>{{ $vente->user->email }}</li>
                </ul>
            </div>
        </div>

        <div class="inv-body">
            <table>
                <thead>
                    <tr>
                        <th>Car</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Payment Method</th>
                        <th>Sold At</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <h4>{{ $vente->car->brand }} {{ $vente->car->model }}</h4>
                            <p>{{ $vente->car->engine }}</p>
                        </td>
                        <td>{{ $vente->price_unit }} $</td>
                        <td>{{ $vente->quantity }}</td>
                        <td>{{ $vente->total_price }} $</td>
                        <td>{{ $vente->payment_method }}</td>
                        <td>{{ $vente->sold_at ?? 'Pending' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="inv-footer">
            <div></div>
            <div>
                <table>
                    <tr>
                        <th>Subtotal</th>
                        <td>{{ $vente->total_price }} $</td>
                    </tr>
                    <tr>
                        <th>Tax (15%)</th>
                        <td>{{ number_format($vente->total_price * 0.15, 2) }} $</td>
                    </tr>
                    <tr>
                        <th style="color: #ff9b00">Total to Pay</th>
                        <td>{{ number_format($vente->total_price * 1.15, 2) }} $</td>
                    </tr>
                </table>
            </div>
        </div>

        <h3 style="text-align: center; margin-top: 30px">
            Thank you for choosing and trusting our car company ❤️
        </h3>
    </div>

    <script>
        window.addEventListener('load', function () {
            window.print();
            setTimeout(() => window.close(), 1000);
        });
    </script>
</body>

</html>
