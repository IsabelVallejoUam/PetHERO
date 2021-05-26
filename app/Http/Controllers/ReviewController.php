<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Walk;
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

            break;
            case "walk":
                return redirect(route('walk.index'))->with('_success', '¡Gracias por tu opinión!');
            break;
            case "product":

            break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
