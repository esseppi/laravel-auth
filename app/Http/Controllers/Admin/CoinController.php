<?php

namespace App\Http\Controllers\Admin;

use App\Coin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coins = Coin::paginate(25);
        return view('admin.coins.index', compact('coins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validationRules = [
            'name'              => 'required|unique:comics|min:1|max:1',
            'thumb'             => 'url|max:2000',
            'description'       => 'max:250',
            'price'             => 'required|numeric',
            'amount'            => 'required|numeric',
        ];
        // validazion
        $request->validate($this->validationRules);
        $newCoin = $request->all();
        $coin = Coin::create($newCoin);
        return redirect()->route('coins.show', $coin->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function show(Coin $coin)
    {
        return view('admin.coins.show', [
            'coin'     => $coin,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function edit(Coin $coin)
    {
        return view('admin.coins.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coin $coin)
    {
        $formData = $request->all();

        $coin->update($formData);

        return redirect()->route('coins.admin.show', $coin->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coin $coin)
    {
        $coin->delete();
        return redirect()->route('comics.admin.index');
    }
}
