<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Coupon;

class Cart extends Model
{
    private $items = [];
    private $total_quantity = 0;
    private $total_price = 0;

    public function __construct()
    {
        $this->items = session('cart') ? session('cart') : [];
    }
    public function list()
    {
        return $this->items;
    }
    public function add($product, $quantity = 1)
    {
        $item = [
            'id' => $product->id,
            'name' => $product->name,
            'price_regular' => $product->price_sale > 0 ? $product->price_sale : $product->price_regular,
            'quantity' => $quantity
        ];
        $this->items[$product->id] = $item;
        session(['cart' => $this->items]);
    }

    //Tổng tiền thanh toán

    public function getFinalPrice(?Coupon $coupon = null)
    {
        $totalPrice = 0;
        foreach ($this->items as $item) {
            $totalPrice += $item['price_regular'] * $item['quantity'];
        }
        // die($coupon);
        // Nếu coupon là null, không áp dụng discount
        if ($coupon) {

            $discountAmount = $coupon->discount($totalPrice); // Tính discount

            return $totalPrice =  $totalPrice - $discountAmount; // Trả về tổng tiền sau khi trừ discount
        }

        // Nếu không có coupon, trả về tổng tiền nguyên bản

        return $totalPrice;
    }


}

