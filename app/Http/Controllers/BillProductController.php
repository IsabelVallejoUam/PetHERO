<?php

namespace App\Http\Controllers;

use App\Models\BillProduct;
use Illuminate\Http\Request;
use Cart;
use App\Models\Bill;

class BillProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    public function createProducts(Request $request){
        $products = Cart::getContent();
        $bill_id = $request->input('bill_id');
        foreach($products as $item){
            $billProduct = new BillProduct();

            $billProduct->price = $item->price;
            $billProduct->name = $item->name;
            $billProduct->quantity = $item->quantity;
            $billProduct->bill_id = $bill_id;

            $billProduct->save();
        }
        return redirect(route('soldProduct.createProducts'));
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BillProduct  $billProduct
     * @return \Illuminate\Http\Response
     */
    public function show(BillProduct $billProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BillProduct  $billProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(BillProduct $billProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BillProduct  $billProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BillProduct $billProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BillProduct  $billProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(BillProduct $billProduct)
    {
        //
    }
}
