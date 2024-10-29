<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
            'img_thumbnail,' => $product->img_thumbnail,
            'price' => $product->price_sale > 0 ? $product->price_sale : $product->price_regular,
            'quantity' => $quantity
        ];
        $this->items[$product->id] = $item;
        session(['cart' => $this->items]);
    }

    //Tổng tiền thanh toán
    public function getTotalPrice()
    {
        $totalPrice = 0;
        foreach ($this->items as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
        return $totalPrice;
    }

    public function getTotalQuantity()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['quantity'];
        }
        return $total;
    }

    public function deleteItems($id)
    {
        if (isset($this->items[$id])) {
            unset($this->items[$id]);
            session(['cart' => $this->items]);
        }
    }
}