@extends('layouts.index')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Invoice</h1>
        </div>
        <div class="row">
            <form action="{{ route('invoices-update', $invoice->id) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="customer">Customer Name</label>
                    <input type="text" name="customer" value="{{ $invoice->customer }}" id="customer" class="form-control"
                        required>
                </div>
                <table id="product_table">
                    <thead>
                        <tr>
                            <th>Fruit Item</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoice->invoiceItems as $item)
                            <tr>
                                <td>
                                    <select class="form-control" name="products[]" required>
                                        <option value="">Select Fruit Item</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}"
                                                {{ $product->id == $item->product_id ? 'selected' : '' }}>
                                                {{ $product->product_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="p-2">
                                    <input class="form-control" type="number" name="quantity[]" min="1"
                                        value="{{ $item->quantity }}" required>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger delete-fruit"><i
                                            class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary" id="add_row"><i class="fas fa-plus"></i></button>
                <div class="pt-4">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-sm-8">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="h3 mb-0 text-gray-800 pt-4">Invoice</h2>
                    <a href="{{ route('invoices-pdf', ['id' => $invoice->id]) }}"><button class="btn btn-primary">Export PDF Invoice</button></a>
                    <form id="delete-form" action="{{ route('invoices-delete', $invoice->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-danger" type="button" id="delete-btn">Delete Invoice</button>
                    </form>
                </div>
               
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
                        @foreach($invoice->invoiceItems as $key => $item)
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
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script>
        var products = @json($products);

        $(document).ready(function() {
            $("#add_row").click(function() {
                var html = '';
                html += '<tr>';
                html += '<td>';
                html += '<select class="form-control" name="products[]" required>';
                html += '<option value="">Select Fruit Item</option>';
                $.each(products, function(index, product) {
                    html += '<option value="' + product.id + '">' + product.product_name +
                        '</option>';
                });
                html += '</select>';
                html += '</td>';
                html += '<td class="p-2">';
                html += '<input class="form-control" type="number" name="quantity[]" min="1" required>';
                html += '</td>';
                html += '<td>';
                html +=
                    '<button type="button" class="btn btn-danger delete-fruit"><i class="fas fa-trash"></i></button>';
                html += '</td>';
                html += '</tr>';
                $('#product_table tbody tr:last').after(html);

                // Disable selected product in other select boxes
                $('select[name="products[]"]').each(function() {
                    var selectedProductId = $(this).val();
                    if (selectedProductId) {
                        $('select[name="products[]"]').not(this).find('option[value="' +
                            selectedProductId + '"]').prop('disabled', true);
                    }
                });
            });

            $('select[name="products[]"]').change(function() {
                var selectedProductId = $(this).val();
                $('select[name="products[]"]').not(this).find('option').prop('disabled',
                false); // Enable all options in other select boxes
                $('select[name="products[]"]').not(this).each(function() {
                    $(this).find('option[value="' + selectedProductId + '"]').prop('disabled',
                    true); // Disable option with selectedProductId
                });
            });

            // Remove row
            $(document).on('click', '.delete-fruit', function() {
                $(this).closest('tr').remove();
            });

            document.getElementById('delete-btn').addEventListener('click', function() {
                if (confirm('Are you sure you want to delete this invoice?')) {
                    document.getElementById('delete-form').submit();
                }
            });
        });

        
    </script>
@endsection
