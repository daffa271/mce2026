<?php

namespace App\Http\Controllers;

use App\Models\DiscountCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscountCodeValidationController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        $code = strtoupper($data['code']);
        $price = (float) $data['price'];

        $discount = DiscountCode::where('code', $code)->first();

        if (!$discount) {
            return response()->json([
                'valid' => false,
                'message' => '❌ Kode diskon tidak ditemukan',
            ], 404);
        }

        if (!$discount->isValid()) {
            return response()->json([
                'valid' => false,
                'message' => '❌ Kode diskon tidak berlaku atau sudah kadaluarsa',
            ], 422);
        }

        $discountAmount = $discount->getDiscountAmount($price);
        $finalPrice = $discount->getFinalPrice($price);

        return response()->json([
            'valid' => true,
            'discount_code_id' => $discount->id,
            'discount_percentage' => $discount->discount_percentage,
            'discount_amount' => $discountAmount,
            'original_price' => $price,
            'final_price' => $finalPrice,
            'message' => '✓ Kode diskon valid! Potongan ' . $discount->discount_percentage . '%',
        ]);
    }
}
