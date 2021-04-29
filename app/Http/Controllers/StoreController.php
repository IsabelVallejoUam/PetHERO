<?php

namespace App\Http\Controllers;
use Image;
use App\Models\Store;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class StoreController extends Controller
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
        return view('store.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = new Store();
        $store->owner_id = Auth::id();
        $store->store_name = $request->input('store_name');
        $store->slogan = $request->input('slogan');
        $store->nit = $request->input('nit');
        $store->description = $request->input('description');
        $store->schedule = $request->input('schedule');
        $store->address = $request->input('address');
        $store->phone_number = $request->input('phone_number');
        $store->score = 0;
        $store->type = $request->input('type');
        if($request->input('type') == 'veterinaria' && $store->photo = null){
            $store->photo = "default_vet.png";
        } else if($request->input('type') == 'tienda' && $store->photo = null){
            $store->photo = "default.png";
        }
        
        
        $store->save();

        return redirect(route('storeOwner.index'))->with('_success', 'Tienda creada exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        $products = Product::ownedBy($store->id)->paginate(5);
        return view('store.show',compact(['store','products']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        return view('store.edit',compact('store'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        $store->store_name = $request->input('store_name');
        $store->slogan = $request->input('slogan');
        $store->nit = $request->input('nit');
        $store->description = $request->input('description');
        $store->schedule = $request->input('schedule');
        $store->address = $request->input('address');
        $store->phone_number = $request->input('phone_number');
        $store->score = 0;
        $store->type = $request->input('type');
        if ($request->hasFile('photo')){
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(300,300)->save(public_path('uploads/stores/'.$filename));
            $store->photo=$filename;
            $store->save();
        }
        $store->save();
        return redirect(route('storeOwner.index'))->with('_success', 'Tienda editada exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        $store->delete();
        return redirect()->route('storeOwner.index')->with('_success', '¡Tienda eliminada exitosamente!');
        

    }
}
