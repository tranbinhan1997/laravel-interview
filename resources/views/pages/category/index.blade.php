@extends('layouts.index')

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Registration Fruit Category</h1>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <form action="{{ route('categories-add') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    <input type="text" name="category_name" value="{{ old('category_name') }}" class="form-control" required>
                    @error('category_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <h2 class="h3 mb-0 text-gray-800 pt-4">Fruit Category List</h2>
            <table class="table mt-2">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category Name</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <th scope="row">{{ $category->id }}</th>
                            <td>{{ ucfirst($category->category_name) }}</td>
                        </tr>
                    @endForeach
                </tbody>
              </table>
              {{ $categories->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@endsection
