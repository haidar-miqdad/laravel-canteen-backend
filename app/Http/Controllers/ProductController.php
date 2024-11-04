<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()
        ->when($request->input('name'), function($query, $name){
            return $query->where('name', 'like', '%'.$name.'%');
        })
        ->orderBy('id', 'desc')
        ->paginate(10);
        return view('pages.products.index', compact('products'));
    }

    public function create(){
        return view('pages.products.create');
    }

    public function store(Request $request){

        // dd($request->all());

        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);


        $filename = time() . '.' . $request->image->extension();
        $request->image->storeAs('products', $filename, 'public');

        $data = $request->all();
        $data['image'] = $filename;

        Product::create($data);

        return redirect()->route('product.index')->with('success', 'Product created successfully.');

    }

    public function edit($id){
        $product = Product::findOrFail($id);
        return view('pages.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product){


        $data = $request->all();

        $product->update($data);

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');

    }

    public function destroy(Product $product){

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }

}
