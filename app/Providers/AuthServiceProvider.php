<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\Event;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {

        // Lắng nghe sự kiện khi người dùng đăng nhập
        Event::listen(Authenticated::class, function ($event) {
            $user = $event->user; // Lấy đối tượng người dùng đã đăng nhập

            // Kiểm tra nếu có giỏ hàng trong session
            $sessionCart = session()->get('cart', []);

            if (!empty($sessionCart)) {
                // Tạo giỏ hàng trong DB cho người dùng nếu chưa có
                $cart = Cart::firstOrCreate(['user_id' => $user->id]);

                foreach ($sessionCart as $productId => $cartItem) {
                    // Kiểm tra nếu sản phẩm đã có trong giỏ hàng
                    $existingItem = $cart->items()->where('product_id', $productId)->first();
                    if ($existingItem) {
                        // Nếu sản phẩm đã có trong giỏ hàng, tăng số lượng
                        $existingItem->quantity += $cartItem['quantity'];
                        $existingItem->save();
                    } else {
                        // Thêm sản phẩm từ session vào giỏ hàng DB
                        $cart->items()->create([
                            'product_id' => $productId,
                            'quantity' => $cartItem['quantity'],
                            'price' => $cartItem['price'],
                        ]);
                    }
                }

                // Xóa giỏ hàng từ session sau khi chuyển sang DB
                session()->forget('cart');
            }
        });
    }
}
