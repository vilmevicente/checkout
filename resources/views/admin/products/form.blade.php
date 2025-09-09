@extends('layouts.app')

@section('title', isset($product) ? 'Editar Produto' : 'Criar Produto')

@section('content')
<div x-data="productForm()">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            {{ isset($product) ? 'Editar Produto' : 'Criar Novo Produto' }}
        </h1>
        <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-gray-800 transition">
            <i class="fas fa-arrow-left mr-2"></i> Voltar
        </a>
    </div>

    <form method="POST" 
          action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}" 
          @submit.prevent="submitForm" class="bg-white rounded-lg shadow-md p-6 mb-6" enctype="multipart/form-data">
        @csrf
        @if(isset($product)) @method('PUT') @endif

        <!-- Informações Básicas -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
                <i class="fas fa-info-circle mr-2"></i> Informações Básicas
            </h2>
            


<div class="mt-4">
           <label class="block text-sm font-medium text-gray-700 mb-2">Nome do Produto *</label>
                    <input type="text" name="name" x-model="formData.name" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
    </div>

            <div class="grid mt-4 grid-cols-1 md:grid-cols-2 gap-6 items-center">
    <!-- Preço normal (sempre visível) -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Preço</label>
        <input type="number" step="0.01" name="price" 
               x-model="formData.price" 
               required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
    </div>

    <!-- Coluna com desconto -->
    <div class="grid grid-cols-2 gap-4 items-center">
        <!-- Checkbox -->
        <div class="flex items-center">
            <label class="inline-flex items-center">

                <input type="hidden" name="produto_com_desconto" value="0">

                <input type="checkbox" name="produto_com_desconto" 
                       x-model="formData.produto_com_desconto" 
                       value="1"
                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"

                >
                <span class="ml-2 text-sm text-gray-700">Produto com Desconto?</span>
            </label>
        </div>

        <!-- Preço com desconto (só aparece se checkbox estiver marcado) -->
        <div x-show="formData.produto_com_desconto" x-cloak>
            <label class="block text-sm font-medium text-gray-700 mb-2">Preço com Desconto *</label>
            <input type="number" step="0.01" name="original_price" 
                   x-model="formData.original_price" 
                   :required="formData.produto_com_desconto"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
        </div>
    </div>
</div>



             <!-- NOVO CAMPO: Success Redirect Link -->
    <div class="mt-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Link de Redirecionamento após Sucesso</label>
        <input type="url" name="success_redirect_link" x-model="formData.success_redirect_link"
               placeholder="https://exemplo.com/obrigado"
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" required>
        <p class="text-xs text-gray-500 mt-1">URL para redirecionar o cliente após compra bem-sucedida</p>
    </div>

            <div>
    <label class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
    <input type="text" name="slug"
           value="{{ old('slug', isset($product) ? $product->slug : '') }}"
           @if(!isset($product)) disabled @endif
           class="w-full px-4 py-2 border border-gray-300 rounded-lg 
                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition 
                  {{ !isset($product) ? 'bg-gray-100 cursor-not-allowed' : '' }}">
    @if(!isset($product))
        <p class="text-xs text-gray-500 mt-1">O slug será gerado automaticamente ao criar o produto.</p>
    @else
        <p class="text-xs text-gray-500 mt-1">Edite o slug somente se necessário (isso altera o link do produto).</p>
    @endif
</div>


            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Descrição</label>
                <textarea name="description" x-model="formData.description" rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"></textarea>
            </div>
        </div>

        <!-- Banners por Upload -->
<div class="mb-8" x-data="bannerManager({ 
        main: '{{ $product->main_banner ?? '' }}', 
        secondary: '{{ $product->secondary_banner ?? '' }}' 
    })">
    <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
        <i class="fas fa-image mr-2"></i> Banners
    </h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Banner Principal --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Banner Principal (Tamanho ideal: 1000x307)</label>
            <input type="file" name="main_banner" accept="image/*"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">

            <template x-if="banners.main">
                <div class="mt-2">
                    <img :src="'/storage/' + banners.main" alt="Banner principal" class="h-20 object-cover rounded">
                    <p class="text-xs text-gray-500 mt-1">Banner atual</p>
                    <button type="button" @click="remove('main')"
                            class="mt-1 text-xs text-red-600 hover:underline">
                        Remover banner
                    </button>
                </div>
            </template>
            <input type="hidden" name="remove_main_banner" x-model="removed.main">
        </div>

        {{-- Banner Secundário --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Banner Secundário (Tamanho ideal: 300x533)</label>
            <input type="file" name="secondary_banner" accept="image/*"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">

            <template x-if="banners.secondary">
                <div class="mt-2">
                    <img :src="'/storage/' + banners.secondary" alt="Banner secundário" class="h-20 object-cover rounded">
                    <p class="text-xs text-gray-500 mt-1">Banner atual</p>
                    <button type="button" @click="remove('secondary')"
                            class="mt-1 text-xs text-red-600 hover:underline">
                        Remover banner
                    </button>
                </div>
            </template>
            <input type="hidden" name="remove_secondary_banner" x-model="removed.secondary">
        </div>
    </div>
</div>

        <!-- Features/Benefícios -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
                <i class="fas fa-star mr-2"></i> Features/Benefícios
            </h2>
            
            <div id="features-container" class="space-y-4">
                <template x-for="(feature, index) in formData.features" :key="index">
                    <div class="feature-item p-4 border border-gray-200 rounded-lg bg-gray-50">
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                            <div class="md:col-span-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Ícone</label>
                                <select :name="`features[${index}][icon]`" x-model="feature.icon"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                    <option value="">Selecione um ícone</option>
                                    <option value="fa-bolt">⚡ Lightning (fa-bolt)</option>
                                    <option value="fa-whatsapp">💬 WhatsApp (fa-whatsapp)</option>
                                    <option value="fa-crown">👑 Premium (fa-crown)</option>
                                    <option value="fa-gift">🎁 Presente (fa-gift)</option>
                                    <option value="fa-clock">⏰ Tempo (fa-clock)</option>
                                    <option value="fa-shield">🛡️ Segurança (fa-shield)</option>
                                    <option value="fa-rocket">🚀 Foguete (fa-rocket)</option>
                                    <option value="fa-users">👥 Usuários (fa-users)</option>
                                    <option value="fa-mobile">📱 Mobile (fa-mobile)</option>
                                    <option value="fa-globe">🌎 Global (fa-globe)</option>
                                </select>
                            </div>
                            <div class="md:col-span-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Título</label>
                                <input type="text" :name="`features[${index}][name]`" x-model="feature.name"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                       placeholder="Ex: Acesso Imediato">
                            </div>
                            <div class="md:col-span-3">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Descrição</label>
                                <input type="text" :name="`features[${index}][description]`" x-model="feature.description"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                       placeholder="Ex: Utilize já após a compra">
                            </div>
                            <div class="md:col-span-1 flex items-end">
                                <button type="button" @click="removeFeature(index)" 
                                        class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <button type="button" @click="addFeature" class="mt-4 bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg transition">
                <i class="fas fa-plus mr-2"></i> Adicionar Feature
            </button>
        </div>

        <!-- Depoimentos -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
                <i class="fas fa-comment mr-2"></i> Depoimentos
            </h2>
            
            <div id="testimonials-container" class="space-y-4">
                <template x-for="(testimonial, index) in formData.testimonials" :key="index">
                    <div class="testimonial-item p-4 border border-gray-200 rounded-lg bg-gray-50">
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                            <div class="md:col-span-3">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                                <input type="text" :name="`testimonials[${index}][username]`" x-model="testimonial.username"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                       placeholder="Ex: @cliente">
                            </div>
                            <div class="md:col-span-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Texto do Depoimento</label>
                                <textarea :name="`testimonials[${index}][text]`" x-model="testimonial.text" rows="2"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                       placeholder="Ex: Produto incrível!"></textarea>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Foto (URL)</label>
                                <input type="url" :name="`testimonials[${index}][image]`" x-model="testimonial.image"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                       placeholder="https://...">
                            </div>
                            <div class="md:col-span-1 flex items-end">
                                <button type="button" @click="removeTestimonial(index)" 
                                        class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mt-2" x-show="testimonial.image">
                            <img :src="testimonial.image" alt="Preview" class="h-12 w-12 rounded-full object-cover">
                        </div>
                    </div>
                </template>
            </div>

            <button type="button" @click="addTestimonial" class="mt-4 bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg transition">
                <i class="fas fa-plus mr-2"></i> Adicionar Depoimento
            </button>
        </div>




<!-- Conteúdo de Entrega -->
<div class="mb-8" x-data>
    <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
        <i class="fas fa-envelope mr-2"></i> Conteúdo de Entrega
    </h2>
    
    <label class="block text-sm font-medium text-gray-700 mb-2">Conteúdo para Email</label>
    <textarea 
        id="delivery_content"
        name="delivery_content"
        class="delivery_content w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
        x-ref="deliveryEditor"
        x-init="
            ClassicEditor.create($refs.deliveryEditor, {
                toolbar: [
                    'undo','redo','|',
                    'heading','|',
                    'bold','italic','underline','link','|',
                ]
            })
            .then(editor => {
                // Inicializa o conteúdo no editor a partir do formData
                editor.setData(formData.delivery_content || '');

                // Sempre que o editor mudar, atualiza o Alpine
                editor.model.document.on('change:data', () => {
                    formData.delivery_content = editor.getData();
                });
            })
            .catch(error => console.error(error));
        "
    >{!! old('delivery_content', isset($product) ? $product->delivery_content : '') !!}</textarea>
</div>
   <!-- Upsells (Opcional) -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
                <i class="fas fa-tags mr-2"></i> Upsells (Opcional)
            </h2>
            
            <div id="upsells-container" class="space-y-4">
                <template x-for="(upsell, index) in formData.upsells" :key="index">
                    <div class="upsell-item p-4 border border-gray-200 rounded-lg bg-gray-50">
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                            <div class="md:col-span-5">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Produto</label>
                                <select :name="`upsells[${index}][product_id]`" x-model="upsell.product_id"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                    <option value="">Selecione um produto (opcional)</option>
                                    @foreach($products as $prod)
                                    <option value="{{ $prod->id }}" 
                                            :selected="upsell.product_id == {{ $prod->id }}">
                                        {{ $prod->name }} - R$ {{ number_format($prod->price, 2, ',', '.') }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="md:col-span-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Preço com Desconto</label>
                                <input type="number" step="0.01" :name="`upsells[${index}][discount_price]`" 
                                       x-model="upsell.discount_price" placeholder="Opcional"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            </div>
                            <div class="md:col-span-3 flex items-end">
                                <button type="button" @click="removeUpsell(index)" 
                                        class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">
                                    <i class="fas fa-trash mr-1"></i> Remover
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <button type="button" @click="addUpsell" class="mt-4 bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg transition">
                <i class="fas fa-plus mr-2"></i> Adicionar Upsell
            </button>
        </div>

      <!-- Métodos de Entrega -->

      <!-- Métodos de Entrega -->
<!-- Métodos de Entrega -->
  <!-- Métodos de Entrega -->
    <div class="mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
            <i class="fas fa-paper-plane mr-2 "></i> Métodos de Entrega *
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($deliveryMethods as $method)
                <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition">
                    <input type="radio"
                           name="delivery_method"
                           value="{{ $method->id }}"
                           :checked="formData.delivery_methods == {{ $method->id }}"
                           @change="selectDeliveryMethod({{ $method->id }})"
                           class="mr-3 h-5 w-5 text-blue-600 focus:ring-blue-500">
                      <span class="text-sm font-medium text-gray-700">{{ $method->name }}</span>
                </label>
            @endforeach
        </div>

        <input type="hidden" name="delivery_methods[]" :value="formData.delivery_methods">
    </div>

    <!-- Aviso -->
    <div x-show="requiresFiles" class="mt-2 text-sm text-red-500">
        Este método requer arquivos.
    </div>

    <!-- Anexos -->
    <div class="mb-8" x-show="requiresFiles" x-cloak>
        <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
            <i class="fas fa-paperclip mr-2"></i> Anexos *
        </h2>

        <div id="attachments-container" class="space-y-4">
            <template x-for="(attachment, index) in formData.attachments" :key="index">
                <div class="attachment-item p-4 border border-gray-200 rounded-lg bg-gray-50">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <div class="md:col-span-5">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nome do Arquivo *</label>
                            <input type="text" :name="`attachments[${index}][name]`" x-model="attachment.name" 
                                   required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        </div>
                        <div class="md:col-span-5">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <span x-text="attachment.id ? 'Substituir arquivo (opcional)' : 'Selecionar arquivo *'"></span>
                            </label>
                            <input type="file" :name="`attachments[${index}][file]`" 
                                   @change="attachment.file = $event.target.files[0]"
                                   :required="!attachment.id"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            <input type="hidden" :name="`attachments[${index}][id]`" x-model="attachment.id">
                        </div>
                        <div class="md:col-span-2 flex items-end">
                            <button type="button" @click="removeAttachment(index)" 
                                    class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <button type="button" @click="addAttachment" class="mt-4 bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg transition">
            <i class="fas fa-plus mr-2"></i> Adicionar Anexo
        </button>
    </div>

        <!-- Status -->
        <div class="mb-8">
            <label class="flex items-center">
                <input type="checkbox" name="is_active" x-model="formData.is_active" 
                       class="mr-3 h-5 w-5 text-blue-600 rounded focus:ring-blue-500">
                <span class="text-sm font-medium text-gray-700">Produto Ativo</span>
            </label>
        </div>


<!-- Novos Campos Extras -->
<div class="mb-8">
    <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
        <i class="fas fa-plus-circle mr-2"></i> Texto Personalizado Checkout (Opcional)
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Upsells Title -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Título dos Upsells</label>
            <input type="text" name="upsells_title" x-model="formData.upsells_title"
                   value="{{ old('upsells_title', $product->upsells_title ?? '') }}"
                   placeholder="Valor padrão: Adicione e Economize Mais"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
        </div>

        <!-- Reviews Title -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Título das Reviews</label>
            <input type="text" name="reviews_title" x-model="formData.reviews_title"
                   value="{{ old('reviews_title', $product->reviews_title ?? '') }}"
                   placeholder="Valor Padrão: O que nossos clientes dizem"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
        <!-- Timer Text -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Texto do Timer</label>
            <input type="text" name="timer_text" x-model="formData.timer_text"
                   value="{{ old('timer_text', $product->timer_text ?? '') }}"
                   placeholder="Valor padrão: Aproveite agora o desconto especial!"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
        </div>

        <!-- Features Button Text -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Texto do Botão de Features</label>
            <input type="text" name="features_button_text" x-model="formData.features_button_text"
                   value="{{ old('features_button_text', $product->features_button_text ?? '') }}"
                   placeholder="Valor padrão: SEUS BENEFÍCIOS EXCLUSIVOS "
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
        </div>
    </div>

    <!-- Features Icon (ícone padrão geral para lista de benefícios, se precisar) -->
    <div class="mt-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Ícone Padrão para Features</label>
        <select name="features_icon" x-model="formData.features_icon"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            <option value="">Selecione um ícone</option>
            <option value="fa-bolt" {{ isset($product) && $product->features_icon === 'fa-bolt' ? 'selected' : '' }}>⚡ Lightning (fa-bolt)</option>
            <option value="fa-whatsapp" {{ isset($product) && $product->features_icon === 'fa-whatsapp' ? 'selected' : '' }}>💬 WhatsApp (fa-whatsapp)</option>
            <option value="fa-crown" {{ isset($product) && $product->features_icon === 'fa-crown' ? 'selected' : '' }}>👑 Premium (fa-crown)</option>
            <option value="fa-gift" {{ isset($product) && $product->features_icon === 'fa-gift' ? 'selected' : '' }}>🎁 Presente (fa-gift)</option>
            <option value="fa-clock" {{ isset($product) && $product->features_icon === 'fa-clock' ? 'selected' : '' }}>⏰ Tempo (fa-clock)</option>
            <option value="fa-shield" {{ isset($product) && $product->features_icon === 'fa-shield' ? 'selected' : '' }}>🛡️ Segurança (fa-shield)</option>
            <option value="fa-rocket" {{ isset($product) && $product->features_icon === 'fa-rocket' ? 'selected' : '' }}>🚀 Foguete (fa-rocket)</option>
            <option value="fa-users" {{ isset($product) && $product->features_icon === 'fa-users' ? 'selected' : '' }}>👥 Usuários (fa-users)</option>
            <option value="fa-mobile" {{ isset($product) && $product->features_icon === 'fa-mobile' ? 'selected' : '' }}>📱 Mobile (fa-mobile)</option>
            <option value="fa-globe" {{ isset($product) && $product->features_icon === 'fa-globe' ? 'selected' : '' }}>🌎 Global (fa-globe)</option>
        </select>
    </div>
</div>




        <!-- Botões de Ação -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.products.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg transition">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition">
                {{ isset($product) ? 'Atualizar' : 'Criar' }} Produto
            </button>
        </div>
    </form>
</div>



<!-- CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>


<script>


function bannerManager(initial) {
    return {
        banners: {
            main: initial.main || '',
            secondary: initial.secondary || '',
        },
        removed: {
            main: '',
            secondary: '',
        },
        remove(type) {
            this.banners[type] = '';       // remove visualmente
            this.removed[type] = '1';      // backend vai saber que removeu
        }
    }
}

function productForm() {
    return {
        formData: {
            name: '{{ old('name', isset($product) ? $product->name : '') }}',
            price: '{{ old('price', isset($product) ? $product->price : '') }}',
            original_price: '{{ old('original_price', isset($product) ? $product->original_price : '') }}',
            success_redirect_link: '{{ old('success_redirect_link', isset($product) ? $product->success_redirect_link : '') }}', // NOVO CAMPO
            description: `{!! old('description', isset($product) ? addslashes($product->description) : '') !!}`,
            delivery_content: `{!! old('delivery_content', isset($product) ? addslashes($product->delivery_content) : '') !!}`,
            is_active: {{  boolval(old('is_active', isset($product) ? $product->is_active : true)) ? 'true' : 'false' }},
            upsells: @json($upsellsData ?? []),
            attachments: @json($attachmentsData ?? []),
            features: @json($featuresData ?? []),
            testimonials: @json($testimonialsData ?? []),
            delivery_methods: @json($deliveryMethodsData ?? []),
            upsells_title: '{{ old('upsells_title', isset($product) ? $product->upsells_title : '') }}',
            features_icon: '{{ old('features_icon', isset($product) ? $product->features_icon : '') }}',
            features_button_text: '{{ old('features_button_text', isset($product) ? $product->features_button_text : '') }}',
            reviews_title:'{{ old('reviews_title', isset($product) ? $product->reviews_title : '') }}',
            timer_text: '{{ old('timer_text', isset($product) ? $product->timer_text : '') }}',
            produto_com_desconto: {{  boolval(old('produto_com_desconto', isset($product) ? $product->produto_com_desconto : true)) ? 'true' : 'false' }},

        },
        
        requiresFiles: false,

        init() {
    const filesMethodId = {{ $filesMethodId ?? 'null' }};
    if (filesMethodId) {
        this.requiresFiles = this.formData.delivery_methods.includes(filesMethodId);
        if (this.requiresFiles && this.formData.attachments.length === 0) {
            this.addAttachment();
        }
    }
},

        addFeature() {
            this.formData.features.push({
                icon: '',
                name: '',
                description: ''
            });
        },

        removeFeature(index) {
            this.formData.features.splice(index, 1);
        },

        addTestimonial() {
            this.formData.testimonials.push({
                username: '',
                text: '',
                image: ''
            });
        },

        removeTestimonial(index) {
            this.formData.testimonials.splice(index, 1);

        },

        addUpsell() {
            this.formData.upsells.push({
                product_id: '',
                discount_price: ''
            });
        },

        removeUpsell(index) {
            this.formData.upsells.splice(index, 1);
        },

        addAttachment() {
            this.formData.attachments.push({
                name: '',
                file: null,
                id: null,
                original_name: '',
                formatted_size: ''
            });
        },

        removeAttachment(index) {
            if (this.formData.attachments.length > 1) {
                this.formData.attachments.splice(index, 1);
            } else {
                alert('É necessário ter pelo menos um anexo quando o método de entrega inclui arquivos.');
            }
        },

         selectDeliveryMethod(methodId) {
            this.formData.delivery_methods = [methodId];
            const filesMethodId = {{ $filesMethodId ?? 'null' }};
            this.requiresFiles = (methodId == filesMethodId);
            if (this.requiresFiles && this.formData.attachments.length === 0) {
                this.addAttachment();
            } else if (!this.requiresFiles) {
                this.formData.attachments = [];
            }
        }
,
        submitForm() {
            if (!this.formData.name || !this.formData.price || this.formData.delivery_methods.length === 0) {
                alert('Por favor, preencha os campos obrigatórios.');
                return;
            }



            if (this.formData.produto_com_desconto==true && this.formData.original_price >= this.formData.price) {
    alert('O preço com desconto deve ser menor que o preço normal do produto.');
    return;
}


            if (this.requiresFiles) {
                if (this.formData.attachments.length === 0) {
                    alert('Por favor, adicione pelo menos um anexo.');
                    return;
                }

                for (let i = 0; i < this.formData.attachments.length; i++) {
                    const attachment = this.formData.attachments[i];
                    if (!attachment.name) {
                        alert('Por favor, preencha o nome para todos os anexos.');
                        return;
                    }
                    if (!attachment.id && !attachment.file) {
                        alert('Por favor, selecione um arquivo para todos os anexos.');
                        return;
                    }
                }
            }

            this.$el.submit();
        }
    }
}
</script>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection