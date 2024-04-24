@extends('layouts.index')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Invoice</h1>
        </div>
        <div class="row">
            <form action="{{ route('invoices-add') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="customer">Customer Name</label>
                    <input type="text" name="customer" value="{{ old('customer') }}" id="customer" class="form-control"
                        required>
                    @error('customer')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <table id="product_table">
                    <thead>
                        <tr>
                            <th>Fruit Item</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select class="form-control" name="products[]" required>
                                    <option value="">Select Fruit Item</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                    @endForeach
                                </select>
                            </td>
                            <td class="p-2">
                                <input class="form-control" type="number" name="quantity[]" min="1" required>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger delete-fruit"><i
                                        class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary" id="add_row"><i class="fas fa-plus"></i></button>
                <div class="pt-4">
                    <button class="btn btn-primary" id="add_row">Create</button>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <h2 class="h3 mb-0 text-gray-800 pt-4">invoice List</h2>
                <table class="table mt-2">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Customer</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $invoice)
                            <tr>
                                <th scope="row">{{ $invoice->id }}</th>
                                <td>{{ ucfirst($invoice->customer) }}</td>
                                <td>
                                   <a href="{{ route('invoices-edit', ['id' => $invoice->id]) }}"><button class="btn btn-primary"><i class="fas fa-eye"></i></button></a>
                                </td>
                            </tr>
                        @endForeach
                    </tbody>
                </table>
                {{ $invoices->links('pagination::bootstrap-5') }}
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
        });
    </script>
@endsection
