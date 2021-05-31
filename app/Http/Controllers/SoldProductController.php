<?php

namespace App\Http\Controllers;

use App\Models\SoldProduct;
use Illuminate\Http\Request;
use Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class SoldProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showSolds(Request $request)
    {
        $store_id = $request->input('store_id');
        $soldProducts = SoldProduct::where('store_id','=',$store_id)->simplePaginate(5);
        return view('store.sold_products', compact('soldProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SoldProduct  $soldProduct
     * @return \Illuminate\Http\Response
     */
    public function show(SoldProduct $soldProduct)
    {

    }

    public function createProducts()
    {
        $products = Cart::getContent();
        foreach($products as $item){
            $soldProduct = new SoldProduct();
            $product = Product::where('id','=',$item->id)->first();
            $soldProduct->store_id = $product->store_id;
            $soldProduct->product_id = $product->id;
            $soldProduct->pet_owner_id = Auth::id();
            $soldProduct->save();
        }
        return redirect(route('cart.clear'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SoldProduct  $soldProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(SoldProduct $soldProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SoldProduct  $soldProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SoldProduct $soldProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SoldProduct  $soldProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(SoldProduct $soldProduct)
    {
        //
    }
}
