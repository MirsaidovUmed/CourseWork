<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ProductTypes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Products::with('type')->get();
        $productTypes = ProductTypes::all();
        return view('products.index', compact('products', 'productTypes'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type_id' => 'required|exists:product_types,id',
            'price' => 'required|numeric'
        ]);

        Products::create([
            'name' => $request->name,
            'type_id' => $request->type_id,
            'price' => $request->price,
        ]);

        return back()->with('success', 'Product created successfully.');
    }

    public function update(Request $request, int $id): RedirectResponse
    {

        $product = Products::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'type_id' => 'required|exists:product_types,id',
            'price' => 'required|numeric'
        ]);

        $product->update([
            'name' => $request->name,
            'type_id' => $request->type_id,
            'price' => $request->price,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $product = Products::findOrFail($id);
        $product->delete();
        return back()->with('success', 'Product deleted successfully.');
    }
}
