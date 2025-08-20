@extends('layouts.app')

@section('content')
<h1>Products</h1>
<a href="{{ route('products.create') }}">Add Product</a>
<table border="1" cellpadding="10">
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Created At</th>
        <th>Actions</th>
        <th>User ID</th>
    </tr>
    @foreach($products as $product)
    <tr>
        <td>{{ $product->name }}</td>
        <td>{{ $product->price }}</td>
        <td>{{ $product->created_at }}</td>
        <td>{{$product->user_id}}</td>
        <td>
            <a href="{{ route('products.edit', $product) }}">Edit</a>
            <a href="{{ route('products.destroy', $product) }}" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection
