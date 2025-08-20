<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show all products of a specific user (pass user_id via request)
    public function index(Request $request)
    {
        $userId = $request->input('user_id'); // replace with session or actual logged-in user ID
        $products = Product::where('user_id', $userId)->get();
        $customValue = 'Ahmed';
        return view('products.index', compact('products'));
    }

    // Show create form
    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {

        // dd($request->all()); // Debugging line to check request data
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'user_id' => 'required|integer', // pass user_id in form or hidden input
        ]);
        
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'user_id' => $request->user_id,
        ]);


        /*return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'description' => $product->description,
            'user_id' => $product->user_id,
        ]);*/
        return redirect()->route('products.index', ['user_id' => $request->user_id])
                         ->with('success', 'Product created successfully.');
    }
    // Show edit form
    public function edit(Request $request, Product $product)
    {
        $this->authorizeProduct($product, $request->get('user_id'));
        return view('products.edit', compact('product'));
    }

    // Update product
    public function update(Request $request, Product $product)
    {
        $this->authorizeProduct($product, $request->get('user_id'));

      $request->validate([
        'name' => 'required|string',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'user_id' => 'required|integer',
    ]);

        $product->update($request->only('name', 'price', 'description'));

        return redirect()->route('products.index', ['user_id' => $request->get('user_id')])
                         ->with('success', 'Product updated successfully.');
    }

    // Delete product
    public function destroy(Request $request, Product $product)
    {
        $this->authorizeProduct($product, $request->get('user_id'));

        $product->delete();

        return redirect()->route('products.index', ['user_id' => $request->get('user_id')])
                         ->with('success', 'Product deleted successfully.');
    }

    // Helper function to check ownership
    private function authorizeProduct(Product $product, $userId)
    {
        if ($product->user_id != $userId) {
            abort(403, 'Unauthorized action.');
        }
    }
}

/*public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'user_id' => 'required|integer',
    ]);

    // Extract individual values
    $name = $request->input('name');
    $price = $request->input('price');
    $description = $request->input('description');
    $userId = $request->input('user_id');

    // Create product
    $product = Product::create([
        'name' => $name,
        'price' => $price,
        'description' => $description,
        'user_id' => $userId,
    ]);

    // Return as JSON (or pass to a view)
    return response()->json([
        'id' => $product->id,
        'name' => $product->name,
        'price' => $product->price,
        'description' => $product->description,
        'user_id' => $product->user_id,
    ]);
}*/

