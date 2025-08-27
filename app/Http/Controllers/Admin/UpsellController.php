<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Upsell;
use App\Http\Requests\UpsellRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpsellController extends Controller
{
    public function index()
    {
        $upsells = Upsell::orderBy('order')->get();
        return view('admin.upsells.index', compact('upsells'));
    }

    public function create()
    {
        return view('admin.upsells.create');
    }

    public function store(UpsellRequest $request)
    {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('upsells', 'public');
        }

        // Calculate discount percentage if original price is provided
        if ($data['original_price'] && $data['original_price'] > $data['price']) {
            $data['discount_percentage'] = round(
                (($data['original_price'] - $data['price']) / $data['original_price']) * 100
            );
        }

        Upsell::create($data);

        return redirect()->route('admin.upsells.index')
            ->with('success', 'Upsell criado com sucesso!');
    }

    public function edit(Upsell $upsell)
    {
        return view('admin.upsells.edit', compact('upsell'));
    }

    public function update(UpsellRequest $request, Upsell $upsell)
    {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            // Delete old image
            if ($upsell->image_path) {
                Storage::disk('public')->delete($upsell->image_path);
            }
            $data['image_path'] = $request->file('image')->store('upsells', 'public');
        }

        // Calculate discount percentage if original price is provided
        if ($data['original_price'] && $data['original_price'] > $data['price']) {
            $data['discount_percentage'] = round(
                (($data['original_price'] - $data['price']) / $data['original_price']) * 100
            );
        } else {
            $data['discount_percentage'] = null;
            $data['original_price'] = null;
        }

        $upsell->update($data);

        return redirect()->route('admin.upsells.index')
            ->with('success', 'Upsell atualizado com sucesso!');
    }

    public function destroy(Upsell $upsell)
    {
        if ($upsell->image_path) {
            Storage::disk('public')->delete($upsell->image_path);
        }
        
        $upsell->delete();

        return redirect()->route('admin.upsells.index')
            ->with('success', 'Upsell excluído com sucesso!');
    }

    public function updateOrder(Request $request)
    {
        foreach ($request->order as $order => $id) {
            Upsell::where('id', $id)->update(['order' => $order]);
        }

        return response()->json(['success' => true]);
    }
}