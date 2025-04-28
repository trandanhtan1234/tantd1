<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
</head>
<body>
    <h2>Hi {{ $full }}</h2>
    <p>Thanks for ordering products from our shop, here's your order details:</p>
    <table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse; width: 100%; margin-top: 20px;">
        <thead>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
        </thead>
        <tbody>
            @foreach ($cart as $prd)
                <tr>
                    <td>
                        {{ $prd->name }}:
                        @if(isset($prd->options->attr['Size']) && isset($prd->options->attr['Color']))
                            {{ $prd->options->attr['Size'] }} - {{ $prd->options->attr['Color'] }}
                        @endif
                    </td>
                    <td>{{ $prd->qty }}</td>
                    <td>₫ {{ number_format($prd->price, 0, ',', '.') }}</td>
                    <td>₫ {{ number_format($prd->qty * $prd->price, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>