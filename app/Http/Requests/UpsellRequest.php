<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpsellRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0|gt:price',
            'is_active' => 'boolean',
            'order' => 'integer',
            'discount_percentage' => 'nullable|integer|between:0,100'
        ];

        if ($this->isMethod('POST')) {
            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
        } else {
            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        return $rules;
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->original_price && $this->original_price <= $this->price) {
                $validator->errors()->add(
                    'original_price', 
                    'O preço original deve ser maior que o preço com desconto'
                );
            }
        });
    }
}