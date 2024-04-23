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
                <input type="text" name="customer" value="{{ $invoice->customer }}" id="customer" class="form-control" required>
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
                    @foreach($invoice->invoiceItems as $item)
                    <tr>
                        <td>
                            <select class="form-control" name="products[]" required>
                                <option value="">Select Fruit Item</option>
                                @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ $product->id == $item->product_id ? 'selected' : '' }}>
                                    {{ $product->product_name }}
                                </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="p-2">
                            <input class="form-control" type="number" name="quantity[]" min="1" value="{{ $item->quantity }}" required>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger delete-fruit"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="button" class="btn btn-primary" id="add_row"><i class="fas fa-plus"></i></button>
            <div class="pt-4">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
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
                    $('select[name="products[]"]').not(this).find('option[value="' + selectedProductId + '"]').prop('disabled', true);
                }
            });
        });

        $('select[name="products[]"]').change(function() {
            var selectedProductId = $(this).val();
            $('select[name="products[]"]').not(this).find('option').prop('disabled', false); // Enable all options in other select boxes
            $('select[name="products[]"]').not(this).each(function() {
                $(this).find('option[value="' + selectedProductId + '"]').prop('disabled', true); // Disable option with selectedProductId
            });
        });

        // Remove row
        $(document).on('click', '.delete-fruit', function() {
            $(this).closest('tr').remove();
        });
    });
</script>
@endsection