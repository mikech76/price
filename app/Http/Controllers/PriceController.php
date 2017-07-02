<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Price;
use Auth;

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
        return redirect('/price');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $price = Price::find($id);
        return view('price.show', ['price' => $price]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $price = Price::find($id);
        return view('price.edit', ['action' => '../' . $id, 'method' => 'PATCH', 'price' => $price]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $price       = Price::find($id);
        $price->name = $request->name;
        $price->save();
        return redirect('/price');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $price = Price::find($id);
        $price->delete();
        return redirect('/prices');
    }
}
