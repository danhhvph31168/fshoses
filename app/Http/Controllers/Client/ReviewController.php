<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ReviewRequest;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function handleAddComment(ReviewRequest $request)
    {
        $data = [
            'comment' => $request->comment,
            'product_id' => $request->product_id,
            'user_id' => Auth::user()->id
        ];

        if (Auth::check()) {
            Review::query()->create($data);
        } else {
            toastr()->info('You must log in to comment.');
            return redirect()->route('auth.showFormLogin');
        }

        return redirect()->back();
    }
    public function handleDestroyComment($comment_id)
    {
        $review = Review::query()->findOrFail($comment_id);
        $review->delete();
        return redirect()->back()->with('success', 'Comment was deleted successfully.');
    }
}
