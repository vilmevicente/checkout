<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Upsell;
use App\Models\DeliveryMethod;
use App\Models\ProductAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // ... outros métodos ...

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
            'upsells' => 'nullable|array',
            'upsells.*' => 'exists:upsells,id',
            'delivery_methods' => 'nullable|array',
            'delivery_methods.*' => 'exists:delivery_methods,id',
            'attachments' => 'nullable|array',
            'attachments.*.name' => 'required|string|max:255',
            'attachments.*.file_url' => 'required|url',
        ]);

        // Remover o campo delivery_file (não existe mais)
        unset($validated['delivery_file']);

        $product = Product::create($validated);

        // Processar upsells
        if ($request->has('upsells')) {
            $product->upsells()->sync($request->upsells);
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

        return redirect()->route('products.index')
                         ->with('success', 'Produto criado com sucesso!');
    }

    public function edit(Product $product)
    {
        $upsells = Upsell::where('is_active', true)->get();
        $deliveryMethods = DeliveryMethod::where('is_active', true)->get();
        $product->load('attachments');
        
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
            'upsells' => 'nullable|array',
            'upsells.*' => 'exists:upsells,id',
            'delivery_methods' => 'nullable|array',
            'delivery_methods.*' => 'exists:delivery_methods,id',
            'attachments' => 'nullable|array',
            'attachments.*.name' => 'required|string|max:255',
            'attachments.*.file_url' => 'required|url',
            'attachments.*.id' => 'nullable|exists:product_attachments,id',
        ]);

        // Remover o campo delivery_file (não existe mais)
        unset($validated['delivery_file']);

        $product->update($validated);

        // Processar upsells
        if ($request->has('upsells')) {
            $product->upsells()->sync($request->upsells);
        } else {
            $product->upsells()->detach();
        }

        // Processar métodos de entrega
        if ($request->has('delivery_methods')) {
            $product->deliveryMethods()->sync($request->delivery_methods);
        } else {
            $product->deliveryMethods()->detach();
        }

        // Processar anexos
        $currentAttachmentIds = $product->attachments->pluck('id')->toArray();
        $updatedAttachmentIds = [];

        if ($request->has('attachments')) {
            foreach ($request->attachments as $index => $attachmentData) {
                if (isset($attachmentData['id'])) {
                    // Atualizar anexo existente
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
                    // Criar novo anexo
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

        return redirect()->route('products.index')
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