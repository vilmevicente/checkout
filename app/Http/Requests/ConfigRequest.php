<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'free_shipping_threshold' => 'nullable|numeric|min:0',
            'default_discount_percentage' => 'nullable|integer|between:0,100',
            'checkout_timeout_minutes' => 'nullable|integer|min:1|max:60',
            'max_upsells_per_order' => 'nullable|integer|min:1|max:10',
            'enable_guest_checkout' => 'boolean',
            'require_account_creation' => 'boolean'
        ];
    }
}