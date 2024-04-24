<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="2">Customer</th>
                <th scope="col">{{ $invoice->customer }}</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Category</th>
                <th scope="col">Fruit</th>
                <th scope="col">Unit</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->invoiceItems as $key => $item)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ ucfirst($item->category_name) }}</td>
                    <td>{{ ucfirst($item->product_name) }}</td>
                    <td>{{ ucfirst($item->unit) }}</td>
                    <td>{{ number_format($item->price) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->amount) }}</td>
                </tr>
            @endforeach
            <tr>
                <th></th>
                <td></td>
                <td></td>
                <th></th>
                <td></td>
                <td>Total</td>
                <td>{{ number_format($invoice->total) }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
