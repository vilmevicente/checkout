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
        'attachments.*.file' => 'required|file|max:10240', // 10MB max
    ]);

    $product = Product::create($validated);

    // Processar upsells
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

    // Processar anexos (upload de arquivos)
    if ($request->has('attachments')) {
        foreach ($request->attachments as $index => $attachmentData) {
            if (isset($attachmentData['file']) && $attachmentData['file']->isValid()) {
                $file = $attachmentData['file'];
                $path = $file->store('product-attachments', 'public');
                
                $product->attachments()->create([
                    'name' => $attachmentData['name'],
                    'file_path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'size' => $file->getSize(),
                    'order' => $index,
                    'is_active' => true
                ]);
            }
        }
    }

    return redirect()->route('products.index')
                     ->with('success', 'Produto criado com sucesso!');
}

  

    public function edit(Product $product)
{
    $products = Product::where('is_active', true)
                      ->where('id', '!=', $product->id)
                      ->get();
    $deliveryMethods = DeliveryMethod::where('is_active', true)->get();
    $product->load(['upsells', 'attachments', 'deliveryMethods']);
    
    // Preparar dados dos upsells
    $currentUpsells = $product->upsells->mapWithKeys(function ($upsell) {
        return [
            $upsell->id => [
                'discount_price' => $upsell->pivot->discount_price
            ]
        ];
    });
    
    // Dados para o JavaScript - Anexos
    $attachmentsData = old('attachments', $product->attachments->map(function ($attachment) {
        return [
            'id' => $attachment->id,
            'name' => $attachment->name,
            'original_name' => $attachment->original_name,
            'formatted_size' => $attachment->formatted_size
        ];
    })->toArray());
    
    // ... resto do código ...
    
    return view('admin.products.form', compact('product', 'products', 'deliveryMethods', 'upsellsData', 'attachmentsData', 'deliveryMethodsData'));
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
        'attachments.*.file' => 'nullable|file|max:10240',
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

    // Processar anexos
    $currentAttachmentIds = $product->attachments->pluck('id')->toArray();
    $updatedAttachmentIds = [];

    if ($request->has('attachments')) {
        foreach ($request->attachments as $index => $attachmentData) {
            if (isset($attachmentData['id'])) {
                // Atualizar anexo existente
                $attachment = $product->attachments()->find($attachmentData['id']);
                if ($attachment) {
                    $updateData = [
                        'name' => $attachmentData['name'],
                        'order' => $index,
                        'is_active' => true
                    ];

                    // Se um novo arquivo foi enviado
                    if (isset($attachmentData['file']) && $attachmentData['file']->isValid()) {
                        // Deletar arquivo antigo
                        Storage::disk('public')->delete($attachment->file_path);
                        
                        // Fazer upload do novo arquivo
                        $file = $attachmentData['file'];
                        $path = $file->store('product-attachments', 'public');
                        
                        $updateData = array_merge($updateData, [
                            'file_path' => $path,
                            'original_name' => $file->getClientOriginalName(),
                            'mime_type' => $file->getMimeType(),
                            'size' => $file->getSize()
                        ]);
                    }

                    $attachment->update($updateData);
                    $updatedAttachmentIds[] = $attachmentData['id'];
                }
            } else {
                // Criar novo anexo
                if (isset($attachmentData['file']) && $attachmentData['file']->isValid()) {
                    $file = $attachmentData['file'];
                    $path = $file->store('product-attachments', 'public');
                    
                    $attachment = $product->attachments()->create([
                        'name' => $attachmentData['name'],
                        'file_path' => $path,
                        'original_name' => $file->getClientOriginalName(),
                        'mime_type' => $file->getMimeType(),
                        'size' => $file->getSize(),
                        'order' => $index,
                        'is_active' => true
                    ]);
                    $updatedAttachmentIds[] = $attachment->id;
                }
            }
        }
    }

    // Remover anexos que não estão mais na lista
    $attachmentsToDelete = array_diff($currentAttachmentIds, $updatedAttachmentIds);
    if (!empty($attachmentsToDelete)) {
        foreach ($product->attachments()->whereIn('id', $attachmentsToDelete)->get() as $attachment) {
            Storage::disk('public')->delete($attachment->file_path);
            $attachment->delete();
        }
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