@extends('layouts.app')

@section('title', isset($product) ? 'Editar Produto' : 'Criar Produto')

@section('content')
<div x-data="productForm()">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            {{ isset($product) ? 'Editar Produto' : 'Criar Novo Produto' }}
        </h1>
        <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-gray-800 transition">
            <i class="fas fa-arrow-left mr-2"></i> Voltar
        </a>
    </div>

    <form @submit.prevent="submitForm" class="bg-white rounded-lg shadow-md p-6 mb-6" enctype="multipart/form-data">
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

        <!-- Banners via Upload -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
                <i class="fas fa-image mr-2"></i> Banners (Upload)
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Banner Principal</label>
                    <input type="file" name="main_banner" accept="image/*"
                           @change="formData.main_banner = $event.target.files[0]"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <template x-if="formData.main_banner_url">
                        <div class="mt-2">
                            <p class="text-sm text-gray-600">Banner atual:</p>
                            <img :src="formData.main_banner_url" class="mt-1 h-20 object-cover rounded">
                        </div>
                    </template>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Banner Secundário</label>
                    <input type="file" name="secondary_banner" accept="image/*"
                           @change="formData.secondary_banner = $event.target.files[0]"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <template x-if="formData.secondary_banner_url">
                        <div class="mt-2">
                            <p class="text-sm text-gray-600">Banner atual:</p>
                            <img :src="formData.secondary_banner_url" class="mt-1 h-20 object-cover rounded">
                        </div>
                    </template>
                </div>
            </div>
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

        <!-- Anexos (Condicional) -->
        <div class="mb-8" x-show="requiresFiles">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
                <i class="fas fa-paperclip mr-2"></i> Anexos
                <span class="text-sm font-normal text-gray-600">(Obrigatório para entrega com arquivos)</span>
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
                                    <span x-text="attachment.id ? 'Substituir arquivo' : 'Selecionar arquivo *'"></span>
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

        <!-- Métodos de Entrega (Obrigatório) -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
                <i class="fas fa-truck mr-2"></i> Métodos de Entrega *
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($deliveryMethods as $method)
                <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition">
                    <input type="checkbox" name="delivery_methods[]" value="{{ $method->id }}" 
                           :checked="formData.delivery_methods.includes({{ $method->id }})"
                           @change="toggleDeliveryMethod({{ $method->id }})"
                           class="mr-3 h-5 w-5 text-blue-600 rounded focus:ring-blue-500">
                    <span class="text-sm font-medium text-gray-700">{{ $method->name }}</span>
                </label>
                @endforeach
            </div>
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
            <a href="{{ route('products.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg transition">
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
            main_banner: null,
            main_banner_url: '{{ isset($product) && $product->main_banner_url ? $product->main_banner_url : '' }}',
            secondary_banner: null,
            secondary_banner_url: '{{ isset($product) && $product->secondary_banner_url ? $product->secondary_banner_url : '' }}',
            delivery_content: `{!! old('delivery_content', isset($product) ? addslashes($product->delivery_content) : '') !!}`,
            is_active: {{ old('is_active', isset($product) ? $product->is_active : 'true') }},
            upsells: @json($upsellsData ?? []),
            attachments: @json($attachmentsData ?? []),
            delivery_methods: @json($deliveryMethodsData ?? [])
        },

        get requiresFiles() {
            const filesMethodId = {{ DeliveryMethod::where('type', 'files')->first()->id }};
            return this.formData.delivery_methods.includes(filesMethodId);
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
            this.formData.attachments.splice(index, 1);
        },

        toggleDeliveryMethod(methodId) {
            const index = this.formData.delivery_methods.indexOf(methodId);
            if (index === -1) {
                this.formData.delivery_methods.push(methodId);
            } else {
                this.formData.delivery_methods.splice(index, 1);
            }
        },

        submitForm() {
            // Validação básica
            if (!this.formData.name || !this.formData.price) {
                alert('Por favor, preencha os campos obrigatórios.');
                return;
            }

            // Validar métodos de entrega
            if (this.formData.delivery_methods.length === 0) {
                alert('Por favor, selecione pelo menos um método de entrega.');
                return;
            }

            // Validar upsells duplicados
            const productIds = this.formData.upsells
                .map(upsell => upsell.product_id)
                .filter(id => id !== '');
            
            const uniqueIds = new Set(productIds);
            
            if (productIds.length !== uniqueIds.size) {
                alert('Não é possível selecionar o mesmo produto múltiplas vezes como upsell.');
                return;
            }

            // Validar anexos se necessário
            if (this.requiresFiles) {
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

                if (this.formData.attachments.length === 0) {
                    alert('Para entrega com arquivos, é necessário adicionar pelo menos um anexo.');
                    return;
                }
            }

            // Se tudo estiver ok, submeter o formulário
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