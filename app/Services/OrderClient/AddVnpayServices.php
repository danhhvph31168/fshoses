<?php

namespace App\Services\OrderClient;

use App\Models\{Payment, Vnpay};
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AddVnpayServices
{
    public function addVnPay(Request $request, $order, $payment)
    {
        Vnpay::query()->create([
            'order_id'          => $order,
            'vnp_Amount'        => $request->vnp_Amount,
            'vnp_BankCode'      => $request->vnp_BankCode,
            'vnp_BankTranNo'    => $request->vnp_BankTranNo,
            'vnp_CardType'      => $request->vnp_CardType,
            'vnp_OrderInfo'     => $request->vnp_OrderInfo,
            'vnp_PayDate'       => $request->vnp_PayDate,
            'vnp_ResponseCode'  => $request->vnp_ResponseCode,
            'vnp_TmnCode'       => $request->vnp_TmnCode,
            'vnp_TransactionNo' => $request->vnp_TransactionNo,
            'vnp_TxnRef'        => $request->vnp_TxnRef,
            'vnp_SecureHash'    => $request->vnp_SecureHash,
            'vnp_TransactionStatus' => $request->vnp_TransactionStatus,
        ]);

        Payment::query()->where('id', $payment)->update([
            'status' => Payment::STATUS_PAID
        ]);

        session()->forget('cart');
    }
}
