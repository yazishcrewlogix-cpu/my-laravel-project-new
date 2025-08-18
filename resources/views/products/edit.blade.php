@extends('layouts.app')

@section('content')
<h1>Edit Product</h1>
<form action="{{ route('products.update', $product) }}" method="POST">
    @csrf
    <label>Name:</label>
    <input type="text" name="name" value="{{ $product->name }}" required><br><br>

    <label>Price:</label>
    <input type="number" step="0.01" name="price" value="{{ $product->price }}" required><br><br>

    <label>Description:</label><br>
    <textarea name="description">{{ $product->description }}</textarea><br><br>

    <button type="submit">Update</button>
</form>
@endsection
