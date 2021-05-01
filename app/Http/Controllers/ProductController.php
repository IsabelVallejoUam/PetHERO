<?php

namespace App\Http\Controllers;
use Image;
use App\Models\Store;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
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
    public function create(Request $request)
    {

    }

    public function getData(Request $request)
    {
        
        $store=Store::find($request)->first();
        $store_id=$store->id;
        return view('product.create', compact('store_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->store_id = $request->input('store_id');
        $product->price = $request->input('price');
        $product->name = $request->input('name');
        $product->discount = $request->input('discount');
        $product->description = $request->input('description');
        $product->quantity = $request->input('quantity');
        $product->type = $request->input('type');
        $product->privacy = $request->input('privacy');
        if ($request->hasFile('photo')){
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(300,300)->save(public_path('uploads/products/'.$filename));
            $product->photo=$filename;
        }
        $product->save();
        $store_id = $product->store_id;
        return redirect(route('store.show', $store_id))->with('_success', 'Producto añadido exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->price = $request->input('price');
        $product->name = $request->input('name');
        $product->discount = $request->input('discount');
        $product->description = $request->input('description');
        $product->quantity = $request->input('quantity');
        $product->type = $request->input('type');
        $product->privacy = $request->input('privacy');
        if ($request->hasFile('photo')){
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(300,300)->save(public_path('uploads/products/'.$filename));
            $product->photo=$filename;
        }
        $product->save();
        $store_id = $product->store_id;
        return redirect(route('store.show', $store_id))->with('_success', 'Producto o servicio modificado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $store_id = $product->store_id;
        $product->delete();
        return redirect()->route('store.show', $store_id)->with('_success', '¡Producto o servicio eliminado exitosamente!');
    }
}
