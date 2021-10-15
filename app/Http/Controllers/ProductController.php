<?php

namespace App\Http\Controllers;

use App\Models\Product;
use http\Env\Response;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        if($products)
        {
            return response()->json(['products'=>$products], 200);
        }
        else
        {
            return response()->json(['message'=>'Products not found'],404);
        }
    }

    public function show($id)
    {
        $product = Product::find($id);
        if($product)
        {
            return response()->json(['product'=>$product], 200);
        }
        else
        {
            return response()->json(['message'=>'Product not found'],404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required|max:191',
           'description' => 'required|max:191',
           'price' => 'required|max:191',
           'quantity' => 'required|max:191'
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;

        $product->save();
        return response()->json(['message'=>'Product added successfully'], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:191',
            'description' => 'required|max:191',
            'price' => 'required|max:191',
            'quantity' => 'required|max:191'
        ]);
        $productToUpdate = Product::find($id);
        if ($productToUpdate)
        {
            $productToUpdate->name = $request->name;
            $productToUpdate->description = $request->description;
            $productToUpdate->price = $request->price;
            $productToUpdate->quantity = $request->quantity;

            $productToUpdate->update();
            return response()->json(['message'=>'Product updated successfully'], 200);
        }
        else
        {
            return response()->json(['message'=>'Product failed successfully'], 404);
        }

    }

    public function destroy($id)
    {
        $productToDelete = Product::find($id);
        if ($productToDelete)
        {
            $productToDelete->delete();
            return response()->json(['message'=>'Product deleted successfully'], 200);
        }
        else
        {
            return response()->json(['message'=>'Failed to delete product'], 404);
        }
    }
}
