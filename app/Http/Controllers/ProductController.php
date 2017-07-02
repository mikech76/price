<?php

namespace App\Http\Controllers;

use Auth;
use App\Model\Price;
use App\Model\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int $priceId
     *
     * @return \Illuminate\Http\Response
     */
    public function create($priceId)
    {
        $price = Price::find($priceId);
        if ($price->user_id == Auth::user()->id) {
            return view('product.edit',
                ['action' => '../product', 'method' => 'POST', 'price' => $price, 'product' => new
                Product]);
        } else {
            return redirect('price');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $priceId
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $priceId)
    {
        $price = Price::find($priceId);
        if ($price->user_id == Auth::user()->id) {
            $product           = new Product;
            $product->price_id = $priceId;
            $product->name     = $request->name;
            $product->units    = $request->units;
            $product->price    = str_replace(',', '.', $request->price);
            $product->quantity = (int)$request->quantity;
            $product->save();
        }
        return redirect('price/' . $priceId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $priceId
     * @param  int $productId
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($priceId, $productId)
    {
        $price   = Price::find($priceId);
        $product = Product::find($productId);

        if ($price->user_id == Auth::user()->id && $product->price_id == $priceId) {
            return view('product.edit',
                ['action'  => '../' . $productId, 'method' => 'PATCH', 'price' => $price,
                 'product' => $product]);
        } else {
            return redirect('price/' . $priceId);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $priceId
     * @param  int                      $productId
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $priceId, $productId)
    {
        $price   = Price::find($priceId);
        $product = Product::find($productId);
        if ($price->user_id == Auth::user()->id && $product->price_id == $priceId) {
            $product->name     = $product->name;
            $product->units    = $request->units;
            $product->price    = str_replace(',', '.', $request->price);
            $product->quantity = (int)$request->quantity;
            $product->save();
        }
        return redirect('price/' . $priceId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $priceId
     * @param  int $productId
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($priceId, $productId)
    {
        $price   = Price::find($priceId);
        $product = Product::find($productId);
        if ($price->user_id == Auth::user()->id && $product->price_id == $priceId) {
            $product->delete();
        }
        return redirect('price/' . $priceId);
    }
}
