<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ReviewRequest;
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
    public function handleDestroyComment($product_id)
    {
        $review = Review::where('product_id', $product_id)->where('user_id', Auth::id())->first();
        // dd($review);
        if ($review) {
            $review->delete();
            return redirect()->back()->with('success', 'Comment was deleted successfully.');
        }
     
    }
}
