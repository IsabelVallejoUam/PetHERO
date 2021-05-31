<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function add(Request $request){
        $product = Product::find($request->product_id);
        Cart::add(
            $product->id,
            $product->name,
            $product->price,
            1,
        );
        return back()->with('success',"$product->name !Se ha agregado exitosamente al carrito!");
    }

    public function cart(){
        return view('product.cart');
    }

    public function removeItem(Request $request){
        Cart::remove([
            'id' => $request->id,
        ]);
        return back()->with('success',"Se ha eliminado exitosamente del carrito.");
    }

    public function clear(){
        Cart::clear();
        return view('product.cart');
    }
}