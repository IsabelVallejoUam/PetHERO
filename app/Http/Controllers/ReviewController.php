<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Walk;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
class ReviewController extends Controller
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
        //
    }

    public function makeReview(Request $request)
    {
        $type =$request->input('type');
        $walker_id =$request->input('walker_id');
        $product_id =$request->input('product_id');
        $store_id =$request->input('store_id');
        $walk_id = $request->input('walk_id');
        return view('review.create', compact('type','walker_id','product_id','store_id','walk_id'));
    }

    public function indexStore(Request $request)
    {
        $type ='store';
        $store_id =$request->input('store_id');
        $store = Store::where('id',$store_id)->first();
        $reviews = Review::where('store_id',$store_id)->simplepaginate(6);
        return view('review.index', compact('type','store_id','reviews','store'));
    }

    public function indexProduct(Request $request)
    {
        $type ='product';
        $product_id =$request->input('product_id');
        $product = Product::where('id',$product_id)->first();
        $reviews = Review::where('product_id',$product_id)->simplepaginate(6);
        return view('review.index', compact('type','reviews','product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $review = new Review();
        $review->user_id = Auth::id();
        $review->type =$request->input('type');
        $review->walker_id =$request->input('walker_id');
        $review->product_id =$request->input('product_id');
        $review->store_id =$request->input('store_id');
        $review->commentary = $request->input('commentary');
        $review->rate =$request->input('rate');
        if($request->input('type') == 'walk'){
            $walk = Walk::where('id',$request->input('walk_id'))->first();
            $walk->walker_calification = $request->input('rate');
            $walk->save();
        }
        $review->save();

        switch($review->type){
            case "store":
                return redirect(route('store.showPublic',$request->input('store_id')))->with('_success', '¡Gracias por tu opinión!');
            break;
            case "walk":
                return redirect(route('walk.index'))->with('_success', '¡Gracias por tu opinión!');
            break;
            case "product":
                return redirect(route('product.show', $request->input('store_id')))->with('_success', '¡Gracias por tu opinión!');
            break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        return view('review.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
