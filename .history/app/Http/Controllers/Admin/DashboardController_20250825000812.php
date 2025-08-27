<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\DeliveryMethod;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
            

        // Estatísticas de preços
        $maxPrice = Product::max('price') ?? 0;
        $minPrice = Product::min('price') ?? 0;
        $avgPrice = Product::average('price') ?? 0;

        // Contagens adicionais
        $productsWithUpsellsCount = Product::has('upsells')->count();
        $productsWithAttachmentsCount = Product::has('attachments')->count();
        
        // Correção para a data da última atualização
        $lastUpdated = 'Nunca';
        $lastUpdatedRaw = Product::max('updated_at');
        
        if ($lastUpdatedRaw) {
            // Se for uma string, converter para Carbon primeiro
            if (is_string($lastUpdatedRaw)) {
                $lastUpdated = Carbon::parse($lastUpdatedRaw)->format('d/m/Y H:i');
            } else {
                $lastUpdated = $lastUpdatedRaw->format('d/m/Y H:i');
            }
        }

        return view('dashboard', compact(
            'productsCount',
            'activeProductsCount',
            'upsellsCount',
            'deliveryMethodsCount',
            'recentProducts',
           
            'maxPrice',
            'minPrice',
            'avgPrice',
            'productsWithUpsellsCount',
            'productsWithAttachmentsCount',
            'lastUpdated'
        ));
    }
}