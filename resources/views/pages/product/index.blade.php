@extends('layouts.index')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Registration Fruit Item</h1>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <form action="{{ route('products-add') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="category-id">Category</label>
                        <select class="form-control" id="category-id" name="category_id" required>
                            <option value="">please select</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }} >{{ $category->category_name }}</option>
                            @endForeach()
                        </select>
                        @error('category_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="product-name">Fruit Name</label>
                        <input type="text" name="product_name" value="{{ old('product_name') }}" id="product-name" class="form-control" required>
                        @error('product_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="pr-4">Unit</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" {{ old('unit') == 'Kg' ? 'checked' : '' }} name="unit" id="kg" value="Kg">
                            <label class="form-check-label" for="kg">Kg</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" {{ old('unit') == 'Pcs' ? 'checked' : '' }} name="unit" id="pcs" value="Pcs">
                            <label class="form-check-label" for="pcs">Pcs</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" {{ old('unit') == 'Pack' ? 'checked' : '' }} name="unit" id="pack" value="Pack">
                            <label class="form-check-label" for="pack">Pack</label>
                        </div>
                        @error('unit')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" value="{{ old('price') }}" id="price" class="form-control" required>
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

                <h2 class="h3 mb-0 text-gray-800 pt-4">Fruit Item List</h2>
                <table class="table mt-2">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Unit</th>
                        <th scope="col">Price</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <th scope="row">{{ $product->id }}</th>
                                <td>{{ ucfirst($product->category->category_name) }}</td>
                                <td>{{ ucfirst($product->product_name) }}</td>
                                <td>{{ ucfirst($product->unit) }}</td>
                                <td>{{ number_format($product->price) }}</td>
                            </tr>
                        @endForeach
                    </tbody>
                </table>
              {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
