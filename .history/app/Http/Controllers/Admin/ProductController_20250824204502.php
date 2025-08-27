<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Upsell;
use App\Models\DeliveryMethod;
use App\Models\ProductAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    // ... outros métodos ...
  public function index()
    {
        $products = Product::with('upsells')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $products = Product::where('is_active', true)->get();
        $deliveryMethods = DeliveryMethod::where('is_active', true)->get();
        return view('admin.products.form', compact('products', 'deliveryMethods'));
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
            'upsells' => 'nullable|array',
            'upsells.*.product_id' => 'exists:products,id',
            'upsells.*.discount_price' => 'nullable|numeric|min:0',
            'delivery_methods' => 'nullable|array',
            'delivery_methods.*' => 'exists:delivery_methods,id',
            'attachments' => 'nullable|array',
            'attachments.*.name' => 'required|string|max:255',
            'attachments.*.file_url' => 'required|url',
        ]);

        $product = Product::create($validated);

        // Processar upsells (outros produtos)
        if ($request->has('upsells')) {
            $upsellsData = [];
            foreach ($request->upsells as $index => $upsellData) {
                $upsellsData[$upsellData['product_id']] = [
                    'order' => $index,
                    'discount_price' => $upsellData['discount_price'] ?? null,
                    'is_active' => true
                ];
            }
            $product->upsells()->sync($upsellsData);
        }

        // Processar métodos de entrega
        if ($request->has('delivery_methods')) {
            $product->deliveryMethods()->sync($request->delivery_methods);
        }

        // Processar anexos
        if ($request->has('attachments')) {
            foreach ($request->attachments as $index => $attachmentData) {
                $product->attachments()->create([
                    'name' => $attachmentData['name'],
                    'file_url' => $attachmentData['file_url'],
                    'file_type' => pathinfo($attachmentData['file_url'], PATHINFO_EXTENSION),
                    'order' => $index,
                    'is_active' => true
                ]);
            }
        }

        return redirect()->route('admin.products.index')
                         ->with('success', 'Produto criado com sucesso!');
    }

    public function edit(Product $product)
    {
        $products = Product::where('is_active', true)
                          ->where('id', '!=', $product->id) // Não permitir selecionar a si mesmo
                          ->get();
        $deliveryMethods = DeliveryMethod::where('is_active', true)->get();
        $product->load(['upsells', 'attachments']);
        
        // Preparar dados dos upsells para a view
        $currentUpsells = $product->upsells->mapWithKeys(function ($upsell) use ($product) {
            return [
                $upsell->id => [
                    'discount_price' => $upsell->pivot->discount_price
                ]
            ];
        });
        
        return view('admin.products.form', compact('product', 'products', 'deliveryMethods', 'currentUpsells'));
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
            'upsells' => 'nullable|array',
            'upsells.*.product_id' => 'exists:products,id',
            'upsells.*.discount_price' => 'nullable|numeric|min:0',
            'delivery_methods' => 'nullable|array',
            'delivery_methods.*' => 'exists:delivery_methods,id',
            'attachments' => 'nullable|array',
            'attachments.*.name' => 'required|string|max:255',
            'attachments.*.file_url' => 'required|url',
            'attachments.*.id' => 'nullable|exists:product_attachments,id',
        ]);

        $product->update($validated);

        // Processar upsells
        $upsellsData = [];
        if ($request->has('upsells')) {
            foreach ($request->upsells as $index => $upsellData) {
                $upsellsData[$upsellData['product_id']] = [
                    'order' => $index,
                    'discount_price' => $upsellData['discount_price'] ?? null,
                    'is_active' => true
                ];
            }
        }
        $product->upsells()->sync($upsellsData);

        // Processar métodos de entrega
        if ($request->has('delivery_methods')) {
            $product->deliveryMethods()->sync($request->delivery_methods);
        } else {
            $product->deliveryMethods()->detach();
        }

        // Processar anexos (código mantido igual)
        $currentAttachmentIds = $product->attachments->pluck('id')->toArray();
        $updatedAttachmentIds = [];

        if ($request->has('attachments')) {
            foreach ($request->attachments as $index => $attachmentData) {
                if (isset($attachmentData['id'])) {
                    $attachment = $product->attachments()->find($attachmentData['id']);
                    if ($attachment) {
                        $attachment->update([
                            'name' => $attachmentData['name'],
                            'file_url' => $attachmentData['file_url'],
                            'file_type' => pathinfo($attachmentData['file_url'], PATHINFO_EXTENSION),
                            'order' => $index,
                            'is_active' => true
                        ]);
                        $updatedAttachmentIds[] = $attachmentData['id'];
                    }
                } else {
                    $attachment = $product->attachments()->create([
                        'name' => $attachmentData['name'],
                        'file_url' => $attachmentData['file_url'],
                        'file_type' => pathinfo($attachmentData['file_url'], PATHINFO_EXTENSION),
                        'order' => $index,
                        'is_active' => true
                    ]);
                    $updatedAttachmentIds[] = $attachment->id;
                }
            }
        }

        // Remover anexos que não estão mais na lista
        $attachmentsToDelete = array_diff($currentAttachmentIds, $updatedAttachmentIds);
        if (!empty($attachmentsToDelete)) {
            $product->attachments()->whereIn('id', $attachmentsToDelete)->delete();
        }

        return redirect()->route('admin.products.index')
                         ->with('success', 'Produto atualizado com sucesso!');
    }

    // Método para remover um anexo específico
    public function deleteAttachment(Product $product, ProductAttachment $attachment)
    {
        if ($attachment->product_id === $product->id) {
            $attachment->delete();
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false, 'message' => 'Anexo não pertence ao produto'], 400);
    }
}