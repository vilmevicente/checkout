<?php

namespace App\Http\Controllers;

use App\Models\checkout;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mainProduct = [
        'id' => 1,
        'name' => 'Curso Completo de Marketing Digital',
        'price' => 297,
        'originalPrice' => 497,
        'image' => '/placeholder.svg',
    ];

    $upsells = [
        ['id' => 'up1', 'name' => 'Instagram Ads Avançado', 'price' => 97, 'originalPrice' => 197, 'discount' => '50% OFF', 'image' => '/placeholder.svg'],
        ['id' => 'up2', 'name' => 'Templates Premium', 'price' => 47, 'originalPrice' => 97, 'discount' => '52% OFF', 'image' => '/placeholder.svg'],
    ];

    $depoiment

    return view('checkout', [
        'mainProduct' => $mainProduct,
        'upsells' => $upsells,
        'total' => $mainProduct['price'],
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(checkout $checkout)
    {
        //
    }
}
