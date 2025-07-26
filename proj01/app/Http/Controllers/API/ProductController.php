<?php

namespace App\Http\Controllers\API;

use App\Exceptions\ApiRuleException;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollectionResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private Product $product)
    {
    }

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // return new ProductCollectionResource($this->product->all());
        return new ProductCollectionResource($this->product->paginate(10));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return \App\Models\Product::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // Earger Loading | Lazy Loading
        // return $product->load('categories');
        //return $product->with('categories')->first();
        // return $product->without('categories')->find($product->id);


        //if(!$product) abort(404, "PRODUTO NO ENCONTRADO");


        return new ProductResource($product->load('categories'));;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return $product->name;
    }
}
