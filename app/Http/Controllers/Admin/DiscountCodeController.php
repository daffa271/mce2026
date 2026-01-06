<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCode;
use Illuminate\Http\Request;

class DiscountCodeController extends Controller
{
    public function index()
    {
        $codes = DiscountCode::orderByDesc('created_at')->paginate(15);
        return view('admin.discount-codes.index', compact('codes'));
    }

    public function create()
    {
        return view('admin.discount-codes.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);
        $validated['code'] = strtoupper($validated['code']);
        DiscountCode::create($validated);

        return redirect()->route('admin.discount-codes.index')
            ->with('success', 'Kode diskon berhasil dibuat');
    }

    public function edit(DiscountCode $discountCode)
    {
        return view('admin.discount-codes.edit', compact('discountCode'));
    }

    public function update(Request $request, DiscountCode $discountCode)
    {
        $validated = $this->validateData($request, $discountCode->id);
        $validated['code'] = strtoupper($validated['code']);
        $discountCode->update($validated);

        return redirect()->route('admin.discount-codes.index')
            ->with('success', 'Kode diskon berhasil diperbarui');
    }

    public function destroy(DiscountCode $discountCode)
    {
        $discountCode->delete();
        return redirect()->route('admin.discount-codes.index')
            ->with('success', 'Kode diskon dihapus');
    }

    private function validateData(Request $request, $ignoreId = null): array
    {
        $uniqueRule = 'unique:discount_codes,code' . ($ignoreId ? ',' . $ignoreId : '');

        return $request->validate([
            'code' => ['required', 'string', 'min:3', 'max:20', $uniqueRule],
            'discount_percentage' => ['required', 'integer', 'min:1', 'max:100'],
            'description' => ['nullable', 'string'],
            'valid_from' => ['required', 'date'],
            'valid_until' => ['nullable', 'date', 'after:valid_from'],
            'usage_limit' => ['nullable', 'integer', 'min:1'],
            'is_active' => ['boolean'],
        ]);
    }
}
