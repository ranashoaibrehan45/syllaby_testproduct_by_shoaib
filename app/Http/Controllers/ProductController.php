<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('product.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->name, '-');
        $data['photo'] = $request->file('public/photo')->store('photo');

        $product = Product::create($data);
        if (isset($product->id)) {
            return redirect()
                ->route('product.index')
                ->with('status', 'Product has been created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->name, '-');
        
        if ($request->hasFile('photo')) {
            $data['photo'] = last(explode('/', $request->file('photo')->store('public/photo')));
        }

        if ($product->update($data)) {
            return redirect()
                ->route('product.index')
                ->with('status', 'Product has been updated successfully.');
        }

        return back()->with('error', 'There is some problem, Please try again later.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()
                ->route('product.index')
                ->with('status', 'Product has been deleted successfully.');
    }
}
