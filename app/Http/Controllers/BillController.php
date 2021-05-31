<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\PetOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cart;
use App\Models\BillProduct;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = Bill::where('pet_owner_id',Auth::id())->simplePaginate(5);
        return view('petOwner.bills', compact('bills'));
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
        $bill = new Bill();
        $total = 0;
        $products = Cart::getContent();
        foreach($products as $item){
            $total += $item->quantity * $item->price;
        }
        $bill->total_price = $total;
        $foregin_id = PetOwner::where('user_id','=',Auth::id())->value('user_id');
        $bill->pet_owner_id = $foregin_id;
        $bill->save();
        $id=$bill->id;
        return view('petOwner.pay', compact('id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        $billProducts = BillProduct::where('bill_id',$bill->id)->simplePaginate(5);
        return view('petOwner.bill', compact('billProducts', 'bill'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        //
    }
}
