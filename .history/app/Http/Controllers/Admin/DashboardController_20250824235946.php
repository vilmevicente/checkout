<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Upsell;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     public function index()
    {
        $productsCount = Product::count();
        $activeProductsCount = Product::where('is_active', true)->count();
        $upsellsCount = Product::has('upsells')->count();
        $deliveryMethodsCount = DeliveryMethod::where('is_active', true)->count();
        
        $recentProducts = Product::with(['upsells', 'attachments', 'deliveryMethods'])
            ->latest()
            ->take(10)
            ->get();
            
        $recentUpsells = Product::has('upsellOf')
            ->with(['upsellOf'])
            ->latest()
            ->take(10)
            ->get();

        // Estatísticas de preços
        $maxPrice = Product::max('price') ?? 0;
        $minPrice = Product::min('price') ?? 0;
        $avgPrice = Product::average('price') ?? 0;

        // Contagens adicionais
        $productsWithUpsellsCount = Product::has('upsells')->count();
        $productsWithAttachmentsCount = Product::has('attachments')->count();
        $lastUpdated = Product::max('updated_at')?->format('d/m/Y H:i') ?? 'Nunca';

        return view('admin.dashboard.', compact(
            'productsCount',
            'activeProductsCount',
            'upsellsCount',
            'deliveryMethodsCount',
            'recentProducts',
            'recentUpsells',
            'maxPrice',
            'minPrice',
            'avgPrice',
            'productsWithUpsellsCount',
            'productsWithAttachmentsCount',
            'lastUpdated'
        ));
    }
}