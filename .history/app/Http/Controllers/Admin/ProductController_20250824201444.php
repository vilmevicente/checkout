<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Upsell;
use App\Models\DeliveryMethod;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('upsells')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $upsells = Upsell::where('is_active', true)->get();
        $deliveryMethods = DeliveryMethod::where('is_active', true)->get();
        return view('products.create', compact('upsells', 'deliveryMethods'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'main_banner' => 'nullable|url',
            'secondary_banner' => 'nullable|url',
            'delivery_content' => 'nullable|string',
            'delivery_file' => 'nullable|url',
            'upsells' => 'nullable|array',
            'upsells.*' => 'exists:upsells,id',
            'delivery_methods' => 'nullable|array',
            'delivery_methods.*' => 'exists:delivery_methods,id',
        ]);

        $product = Product::create($validated);

        if ($request->has('upsells')) {
            $product->upsells()->sync($request->upsells);
        }

        if ($request->has('delivery_methods')) {
            $product->deliveryMethods()->sync($request->delivery_methods);
        }

        return redirect()->route('products.index')
                         ->with('success', 'Produto criado com sucesso!');
    }

    public function edit(Product $product)
    {
        $upsells = Upsell::where('is_active', true)->get();
        $deliveryMethods = DeliveryMethod::where('is_active', true)->get();
        return view('products.edit', compact('product', 'upsells', 'deliveryMethods'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'main_banner' => 'nullable|url',
            'secondary_banner' => 'nullable|url',
            'delivery_content' => 'nullable|string',
            'delivery_file' => 'nullable|url',
            'upsells' => 'nullable|array',
            'upsells.*' => 'exists:upsells,id',
            'delivery_methods' => 'nullable|array',
            'delivery_methods.*' => 'exists:delivery_methods,id',
        ]);

        $product->update($validated);

        if ($request->has('upsells')) {
            $product->upsells()->sync($request->upsells);
        } else {
            $product->upsells()->detach();
        }

        if ($request->has('delivery_methods')) {
            $product->deliveryMethods()->sync($request->delivery_methods);
        } else {
            $product->deliveryMethods()->detach();
        }

        return redirect()->route('products.index')
                         ->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
                         ->with('success', 'Produto excluído com sucesso!');
    }
}