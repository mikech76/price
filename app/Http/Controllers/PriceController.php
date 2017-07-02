<?php

namespace App\Http\Controllers;

use Auth;
use App\Model\Price;
use App\Model\Product;
use Illuminate\Http\Request;

class PriceController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $prices = Price::where('user_id', '=', Auth::user()->id)->oldest('name');

        return view('price.index',
            ['user' => 1, 'count' => $prices->get()->count(), 'prices' => $prices->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('price.edit', ['action' => '../price', 'method' => 'POST', 'price' => new Price]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $price          = new Price;
        $price->user_id = Auth::user()->id;
        $price->name    = $request->name;
        $price->save();
        return redirect('price');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $priceId
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $priceId)
    {
        $price    = Price::find($priceId);
        $products = Product::where('price_id', '=', $priceId)->oldest('name');

        if (trim($request->search)) {
            $products->where(function($query) use ($request) {
                $query->where('name', 'like', '%' . trim($request->search) . '%')
                      ->orWhere('price', 'like', '%' . trim($request->search) . '%');
            });
        }

        return view('price.show', ['price'         => $price, 'products' => $products->paginate(10),
                                   'product_count' => $products->get()->count(),
                                   'search'        => $request->search]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $priceId
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($priceId)
    {
        $price = Price::find($priceId);
        if ($price->user_id == Auth::user()->id) {
            return view('price.edit', ['action' => '../' . $priceId, 'method' => 'PATCH', 'price' => $price]);
        } else {
            return redirect('price/' . $priceId);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $priceId
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $priceId)
    {
        $price = Price::find($priceId);
        if ($price->user_id == Auth::user()->id) {
            $price       = Price::find($priceId);
            $price->name = $request->name;
            $price->save();
        }
        return redirect('price');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $priceId
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($priceId)
    {
        $price = Price::find($priceId);
        if ($price->user_id == Auth::user()->id) {
            $price->delete();
        }
        return redirect('price');
    }
}
