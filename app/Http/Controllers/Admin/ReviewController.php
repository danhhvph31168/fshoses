<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    const PATH_VIEW = 'admin.reviews.';

    public function index()
    {
        $reviews = Review::query()->with(['user', 'product'])->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('reviews'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'is_show' => 'required'
        ]);

        $review = Review::query()->findOrFail($id);
        $review->update([
            'is_show' => request('is_show')
        ]);

        return back();
    }
}
