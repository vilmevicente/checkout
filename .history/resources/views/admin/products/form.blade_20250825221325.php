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
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nome do Produto *</label>
                    <input type="text" name="name" x-model="formData.name" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preço *</label>
                        <input type="number" step="0.01" name="price" x-model="formData.price" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preço Original</label>
                        <input type="number" step="0.01" name="original_price" x-model="formData.original_price"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Descrição</label>
                <textarea name="description" x-model="formData.description" rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"></textarea>
            </div>
        </div>

        <!-- Banners por Upload -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
                <i class="fas fa-image mr-2"></i> Banners
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Banner Principal</label>
                    <input type="file" name="main_banner" accept="image/*"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    @if(isset($product) && $product->main_banner)
                    <div class="mt-2">
                        <img src="/storage/{{ $product->main_banner }}" alt="Banner principal" class="h-20 object-cover rounded">
                        <p class="text-xs text-gray-500 mt-1">Banner atual</p>
                    </div>
                    @endif
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Banner Secundário</label>
                    <input type="file" name="secondary_banner" accept="image/*"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    @if(isset($product) && $product->secondary_banner)
                    <div class="mt-2">
                        <img src="/storage/{{ $product->secondary_banner}}" alt="Banner secundário" class="h-20 object-cover rounded">
                        <p class="text-xs text-gray-500 mt-1">Banner atual</p>
                    </div>
                    @endif
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
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
                <i class="fas fa-envelope mr-2"></i> Conteúdo de Entrega
            </h2>
            
            <label class="block text-sm font-medium text-gray-700 mb-2">Conteúdo para Email</label>
            <textarea name="delivery_content" x-model="formData.delivery_content" rows="5"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"></textarea>
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
<select name="delivery_method" 
        x-model="formData.delivery_method" 
        @change="requiresFiles = ($event.target.options[$event.target.selectedIndex].text.includes('arquivos'))"
        class="w-full mb-4 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
    <option value="">Selecione um método</option>
    @foreach($deliveryMethods as $method)
        <option value="{{ $method->id }}">
            {{ $method->name }}
        </option>
    @endforeach
</select>


        <!-- Anexos (Condicional) -->
        <div class="mb-8" x-show="requiresFiles">
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
                                       :required="requiresFiles"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            </div>
                            <div class="md:col-span-5">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <span x-text="attachment.id ? 'Substituir arquivo (opcional)' : 'Selecionar arquivo *'"></span>
                                </label>
                                <input type="file" :name="`attachments[${index}][file]`" 
                                       @change="attachment.file = $event.target.files[0]"
                                       :required="requiresFiles && !attachment.id"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <template x-if="attachment.id">
                                    <p class="text-xs text-gray-500 mt-1">
                                        Arquivo atual: <span x-text="attachment.original_name"></span>
                                        (<span x-text="attachment.formatted_size"></span>)
                                    </p>
                                </template>
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

<script>
function productForm() {
    return {
        formData: {
            name: '{{ old('name', isset($product) ? $product->name : '') }}',
            price: '{{ old('price', isset($product) ? $product->price : '') }}',
            original_price: '{{ old('original_price', isset($product) ? $product->original_price : '') }}',
            description: `{!! old('description', isset($product) ? addslashes($product->description) : '') !!}`,
            delivery_content: `{!! old('delivery_content', isset($product) ? addslashes($product->delivery_content) : '') !!}`,
            is_active: {{  boolval(old('is_active', isset($product) ? $product->is_active : true)) ? 'true' : 'false' }},
            upsells: @json($upsellsData ?? []),
            attachments: @json($attachmentsData ?? []),
            features: @json($featuresData ?? []),
            testimonials: @json($testimonialsData ?? []),
            delivery_methods: @json($deliveryMethodsData ?? [])
        },
        
        requiresFiles: false,

        init() {
            const filesMethodId = {{ $filesMethodId ?? 'null' }};
            if (filesMethodId) {
                this.requiresFiles = this.formData.delivery_methods.includes(filesMethodId);
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

        toggleDeliveryMethod(methodId, methodType) {
            const index = this.formData.delivery_methods.indexOf(methodId);
            if (index === -1) {
                this.formData.delivery_methods.push(methodId);
            } else {
                this.formData.delivery_methods.splice(index, 1);
            }
            
            const filesMethodId = {{ $filesMethodId ?? 'null' }};
            if (filesMethodId) {
                this.requiresFiles = this.formData.delivery_methods.includes(filesMethodId);
            }
            
            if (!this.requiresFiles) {
                this.formData.attachments = [];
            } else if (this.formData.attachments.length === 0) {
                this.addAttachment();
            }
        },

        submitForm() {
            if (!this.formData.name || !this.formData.price || this.formData.delivery_methods.length === 0) {
                alert('Por favor, preencha os campos obrigatórios.');
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