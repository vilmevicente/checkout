<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CheckoutConfig;
use App\Http\Requests\ConfigRequest;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function edit()
    {
        $configs = CheckoutConfig::all()->keyBy('key');
        return view('admin.config.edit', compact('configs'));
    }

    public function update(ConfigRequest $request)
    {
        $validated = $request->validated();

        foreach ($validated as $key => $value) {
            CheckoutConfig::setValue($key, $value);
        }

        return redirect()->route('admin.config.edit')
            ->with('success', 'Configurações atualizadas com sucesso!');
    }

    public function getDiscountRules()
    {
        $rules = CheckoutConfig::getValue('discount_rules', []);
        return response()->json($rules);
    }

    public function updateDiscountRules(Request $request)
    {
        $rules = $request->validate([
            'rules' => 'required|array',
            'rules.*.min_amount' => 'required|numeric|min:0',
            'rules.*.discount_percentage' => 'required|numeric|between:0,100',
            'rules.*.is_active' => 'boolean'
        ]);

        CheckoutConfig::setValue('discount_rules', $rules['rules']);

        return response()->json(['success' => true]);
    }
}