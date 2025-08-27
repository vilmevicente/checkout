<?php

namespace App\Http\Controllers;

use App\Models\checkout;
use App\Models\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($produto)
{
    // Buscar o produto principal (você pode ajustar a lógica para buscar o produto desejado)
    $mainProduct = Product::with(['features', 'testimonials', 'attachments'])
                          ->where('is_active', true)
                          ->firstOrFail();

    // Formatar os dados do produto principal
    $formattedMainProduct = [
        'id' => $mainProduct->id,
        'name' => $mainProduct->name,
        'price' => (float) $mainProduct->price,
        'originalPrice' => (float) $mainProduct->original_price,
        'mainbanner' => $mainProduct->main_banner_url,
        'description' => $mainProduct->description,
        'secondarybanner' => $mainProduct->secondary_banner_url,
        'delivery_content' => $mainProduct->delivery_content,
        'features' => $mainProduct->features->map(function($feature) {
            return [
                'name' => $feature->name,
                'description' => $feature->description,
                'icon' => $feature->icon // assumindo que há um campo 'icon' no modelo Feature
            ];
        })->toArray(),
    ];

    // Buscar upsells ativos
    $upsells = $mainProduct->upsells->map(function($upsell) {
        return [
            'id' => $upsell->id,
            'name' => $upsell->name,
            'price' => (float) $upsell->pivot->discount_price,
            'originalPrice' => (float) $upsell->price,
            'discount' => round((($upsell->price - $upsell->pivot->discount_price) / $upsell->price) * 100) . '% OFF',
            'image' => $upsell->main_banner // ou secondary_banner_url, dependendo da sua necessidade
        ];
    })->toArray();

    // Buscar depoimentos
    $depoimentos = $mainProduct->testimonials->map(function($testimonial) {
        return [
            'name' => $testimonial->name,
            'text' => $testimonial->text, // assumindo que há um campo 'content'
            'image' => $testimonial->image, // assumindo que há um accessor para image_url
            'username' => $testimonial->username // assumindo que há um campo 'username'
        ];
    })->toArray();

    return view('checkout', [
        'mainProduct' => $formattedMainProduct,
        'upsells' => $upsells,
        'depoimentos' => $depoimentos,
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
