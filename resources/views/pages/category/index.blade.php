@extends('layouts.index')

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Registration Fruit Category</h1>
    </div>
    <form action="{{ route('categories-add') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Category Name</label>
            <input type="text" name="category_name" class="form-control">
            @error('category_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection
