@extends('layouts.app')

@section('content')
<h1>Add Product</h1>
<form action="{{ route('products.store') }}" method="POST">
    @csrf
    <label>Name:</label>
    <input type="text" name="name" required><br><br>

    <label>Price:</label>
    <input type="number" step="0.01" name="price" required><br><br>

    <label>Description:</label><br>
    <textarea name="description"></textarea><br><br>

        <input type="hidden" name="user_id" value="{{ auth()->id() }}">


    <button type="submit">Save Product</button>
</form>
@endsection
