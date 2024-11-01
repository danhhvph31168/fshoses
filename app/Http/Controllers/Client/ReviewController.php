<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ReviewRequest;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function handleAddComment(ReviewRequest $request, $product_id)
    {
        $data = [
            'comment' => $request->comment,
            'product_id' => $product_id,
            'user_id' => Auth::user()->id
        ];

        // dd($data);
        if (Review::query()->create($data)) {
            return redirect()->back();
        }
        return redirect()->back();
    }
    
}
