<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->image = 'images/' . $imageName;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }
    public function destroy(Product $product)
    {
        // Verwijder het afbeeldingbestand van de server
        if (file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        // Verwijder het product uit de database
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
