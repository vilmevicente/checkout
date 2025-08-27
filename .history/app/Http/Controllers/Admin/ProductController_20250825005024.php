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
        $filesMethodId = DeliveryMethod::where('type', 'files')->first()->id;
         // Garantir que upsellsData sempre exista
    $upsellsData = old('upsells', []);
    $attachmentsData = old('attachments', []);
    $deliveryMethodsData = old('delivery_methods', []);
    
        return view('admin.products.form', compact('products', 'deliveryMethods', 'upsellsData', 'attachmentsData', 'deliveryMethodsData', 'filesMethodId'));
    }

public function store(Request $request)
{
    // Primeiro, validar os campos básicos
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'original_price' => 'nullable|numeric|min:0',
        'description' => 'nullable|string',
        'main_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'secondary_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'delivery_content' => 'nullable|string',
        'upsells' => 'nullable|array',
        'upsells.*.product_id' => 'exists:products,id',
        'upsells.*.discount_price' => 'nullable|numeric|min:0',
        'delivery_methods' => 'required|array|min:1',
        'delivery_methods.*' => 'exists:delivery_methods,id',
         'features' => 'nullable|array',
        'features.*.icon' => 'required|string',
        'features.*.name' => 'required|string|max:255',
        'features.*.description' => 'required|string|max:500',
        'testimonials' => 'nullable|array',
        'testimonials.*.username' => 'required|string|max:100',
        'testimonials.*.text' => 'required|string|max:500',
        'testimonials.*.image' => 'nullable|url',
    ]);

    // Verificar se o método de entrega requer arquivos
    $filesMethod = DeliveryMethod::where('type', 'files')->first();
    $requiresFiles = $filesMethod && in_array($filesMethod->id, $request->delivery_methods);

    // Adicionar validação condicional para anexos
    if ($requiresFiles) {
        $attachmentValidation = $request->validate([
            'attachments' => 'required|array|min:1',
            'attachments.*.name' => 'required|string|max:255',
            'attachments.*.file' => 'required|file|max:10240',
        ]);
        $validated = array_merge($validated, $attachmentValidation);
    } else {
        // Se não requer arquivos, validar como nullable
        $attachmentValidation = $request->validate([
            'attachments' => 'nullable|array',
            'attachments.*.name' => 'nullable|string|max:255',
            'attachments.*.file' => 'nullable|file|max:10240',
        ]);
        $validated = array_merge($validated, $attachmentValidation);
    }

    // Upload dos banners
    $bannerData = [];
    if ($request->hasFile('main_banner') && $request->file('main_banner')->isValid()) {
        $bannerData['main_banner'] = $request->file('main_banner')->store('product-banners', 'public');
    }
    
    if ($request->hasFile('secondary_banner') && $request->file('secondary_banner')->isValid()) {
        $bannerData['secondary_banner'] = $request->file('secondary_banner')->store('product-banners', 'public');
    }

    

    $product = Product::create(array_merge($validated, $bannerData));

    // Processar upsells (opcional)
    if ($request->has('upsells')) {
        $upsellsData = [];
        foreach ($request->upsells as $index => $upsellData) {
            if (!empty($upsellData['product_id'])) {
                $upsellsData[$upsellData['product_id']] = [
                    'order' => $index,
                    'discount_price' => $upsellData['discount_price'] ?? null,
                    'is_active' => true
                ];
            }
        }
        $product->upsells()->sync($upsellsData);
    }

    // Processar métodos de entrega (obrigatório)
    $product->deliveryMethods()->sync($request->delivery_methods);

    // Processar anexos (apenas se o método for "files" e existirem anexos)
    if ($requiresFiles && $request->has('attachments')) {
        foreach ($request->attachments as $index => $attachmentData) {
            if (isset($attachmentData['file']) && $attachmentData['file']->isValid() && !empty($attachmentData['name'])) {
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

    return redirect()->route('admin.products.index')
                     ->with('success', 'Produto criado com sucesso!');
}


  

public function edit(Product $product)
{
    $products = Product::where('is_active', true)
                      ->where('id', '!=', $product->id)
                      ->get();
    $deliveryMethods = DeliveryMethod::where('is_active', true)->get();
    $filesMethod = DeliveryMethod::where('type', 'files')->first();
    $filesMethodId = $filesMethod ? $filesMethod->id : null;
    
    $product->load(['upsells', 'attachments', 'deliveryMethods', 'features', 'testimonials']);

    // Preparar dados
    $upsellsData = old('upsells', $product->upsells->map(function ($upsell) {
        return ['product_id' => $upsell->id, 'discount_price' => $upsell->pivot->discount_price];
    })->values()->toArray());

    $attachmentsData = old('attachments', $product->attachments->map(function ($attachment) {
        return [
            'id' => $attachment->id,
            'name' => $attachment->name,
            'original_name' => $attachment->original_name,
            'formatted_size' => $attachment->formatted_size
        ];
    })->toArray());

    $featuresData = old('features', $product->features->map(function ($feature) {
        return [
            'icon' => $feature->icon,
            'name' => $feature->name,
            'description' => $feature->description
        ];
    })->toArray());

    $testimonialsData = old('testimonials', $product->testimonials->map(function ($testimonial) {
        return [
            'username' => $testimonial->username,
            'text' => $testimonial->text,
            'image' => $testimonial->image
        ];
    })->toArray());

    $deliveryMethodsData = old('delivery_methods', $product->deliveryMethods->pluck('id')->toArray());

    return view('products.form', compact(
        'product', 'products', 'deliveryMethods', 'upsellsData', 
        'attachmentsData', 'featuresData', 'testimonialsData', 
        'deliveryMethodsData', 'filesMethodId'
    ));
}

    
public function update(Request $request, Product $product)
{
    // Primeiro, validar os campos básicos
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'original_price' => 'nullable|numeric|min:0',
        'description' => 'nullable|string',
        'main_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'secondary_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'delivery_content' => 'nullable|string',
        'upsells' => 'nullable|array',
        'upsells.*.product_id' => 'exists:products,id',
        'upsells.*.discount_price' => 'nullable|numeric|min:0',
        'delivery_methods' => 'required|array|min:1',
        'delivery_methods.*' => 'exists:delivery_methods,id',
    ]);

    // Verificar se o método de entrega requer arquivos
    $filesMethod = DeliveryMethod::where('type', 'files')->first();
    $requiresFiles = $filesMethod && in_array($filesMethod->id, $request->delivery_methods);

    // Adicionar validação condicional para anexos
    if ($requiresFiles) {
        $attachmentValidation = $request->validate([
            'attachments' => 'required|array|min:1',
            'attachments.*.name' => 'required|string|max:255',
            'attachments.*.file' => 'nullable|file|max:10240',
            'attachments.*.id' => 'nullable|exists:product_attachments,id',
        ]);
        $validated = array_merge($validated, $attachmentValidation);
    } else {
        // Se não requer arquivos, validar como nullable
        $attachmentValidation = $request->validate([
            'attachments' => 'nullable|array',
            'attachments.*.name' => 'nullable|string|max:255',
            'attachments.*.file' => 'nullable|file|max:10240',
            'attachments.*.id' => 'nullable|exists:product_attachments,id',
        ]);
        $validated = array_merge($validated, $attachmentValidation);
    }

    // Upload dos banners
    $bannerData = [];
    if ($request->hasFile('main_banner') && $request->file('main_banner')->isValid()) {
        // Deletar banner antigo
        if ($product->main_banner_path) {
            Storage::disk('public')->delete($product->main_banner_path);
        }
        $bannerData['main_banner'] = $request->file('main_banner')->store('product-banners', 'public');
    }
    
    if ($request->hasFile('secondary_banner') && $request->file('secondary_banner')->isValid()) {
        // Deletar banner antigo
        if ($product->secondary_banner_path) {
            Storage::disk('public')->delete($product->secondary_banner_path);
        }
        $bannerData['secondary_banner'] = $request->file('secondary_banner')->store('product-banners', 'public');
    }

    $product->update(array_merge($validated, $bannerData));

    // Processar upsells (opcional)
    $upsellsData = [];
    if ($request->has('upsells')) {
        foreach ($request->upsells as $index => $upsellData) {
            if (!empty($upsellData['product_id'])) {
                $upsellsData[$upsellData['product_id']] = [
                    'order' => $index,
                    'discount_price' => $upsellData['discount_price'] ?? null,
                    'is_active' => true
                ];
            }
        }
    }
    $product->upsells()->sync($upsellsData);

    // Processar métodos de entrega (obrigatório)
    $product->deliveryMethods()->sync($request->delivery_methods);

    // Processar anexos (apenas se o método for "files")
    $currentAttachmentIds = $product->attachments->pluck('id')->toArray();
    $updatedAttachmentIds = [];

    if ($requiresFiles && $request->has('attachments')) {
        foreach ($request->attachments as $index => $attachmentData) {
            if (isset($attachmentData['id'])) {
                // Atualizar anexo existente
                $attachment = $product->attachments()->find($attachmentData['id']);
                if ($attachment) {
                    $updateData = [
                        'name' => $attachmentData['name'] ?? $attachment->name,
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
                if (isset($attachmentData['file']) && $attachmentData['file']->isValid() && !empty($attachmentData['name'])) {
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

    // Remover anexos se não forem mais necessários ou se foram deletados
    $attachmentsToDelete = array_diff($currentAttachmentIds, $updatedAttachmentIds);
    if (!empty($attachmentsToDelete)) {
        foreach ($product->attachments()->whereIn('id', $attachmentsToDelete)->get() as $attachment) {
            Storage::disk('public')->delete($attachment->file_path);
            $attachment->delete();
        }
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

      public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')
                         ->with('success', 'Produto excluído com sucesso!');
    }
}