<?php

namespace App\Services\OrderClient;

use App\Http\Requests\Client\CheckoutRequest;
use App\Models\{Order, User};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AddOrderServices
{
    public function dataOrderItem()
    {
        $totalAmount = 0;
        $dataItem = [];
        foreach (session('cart') as $variantID => $item) {
            $price = $item['price_regular'] * ((100 - $item['price_sale']) / 100);

            $totalAmount = session('totalAmount');

            $dataItem[] = [
                'product_variant_id' => $variantID,
                'quantity'           => $item['quatity'],
                'price'              => $price ?: $item['price_regular'],
            ];
        }

        return [$totalAmount, $dataItem];
    }

    public function notLogin(CheckoutRequest $request, $totalAmount)
    {
        if (User::where('email', $request->user_email)->exists()) {

            $checkStatus = User::where('email', $request->user_email)->where('status', 1)->first();

            if ($checkStatus == false) {
                $user = User::where('email', $request->user_email)->first();
            } else {
                return back()->with('info', 'This email already has an account, please login to purchase.');
            }
        } else {
            $user = User::query()->create([
                'name'  => $request->user_name,
                'email' => $request->user_email,
                'phone' => $request->user_phone,
                'address' => $request->user_address,
                'role_id' => 3,
                'status'  => false,
            ]);
        }

        // dd(session('coupon')['coupon_id']);

        $order = Order::query()->create([
            'user_id'    => $user->id,
            // 'role_id'    => null,
            'coupon_id' => session('coupon')['coupon_id'],
            'sku_order'  => 'DH-' . strtoupper(Str::random(6)),
            'user_name'  => $request->user_name,
            'user_email' => $request->user_email,
            'user_phone' => $request->user_phone,
            'user_address' => $request->user_address,
            'user_province' => $request->provinceText,
            'user_district' => $request->districtText,
            'user_ward' => $request->wardText,
            'user_note'    => $request->user_note,
            'total_amount' => $totalAmount,
        ]);

        return $order;
    }

    public function loggedIn(CheckoutRequest $request, $totalAmount)
    {
        $order = Order::query()->create([
            'user_id'    => Auth::user()->id,
            // 'role_id'    => Auth::user()->role_id,
            'coupon_id' => session('coupon')['coupon_id'],
            'sku_order'  => 'DH-' . strtoupper(Str::random(6)),
            'user_name'  => $request->user_name,
            'user_email' => $request->user_email,
            'user_phone' => $request->user_phone,
            'user_address' => $request->user_address,
            'user_province' => $request->provinceText,
            'user_district' => $request->districtText,
            'user_ward' => $request->wardText,
            'user_note'    => $request->user_note,
            'total_amount' => $totalAmount,
        ]);

        return $order;
    }
}
