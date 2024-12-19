<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    const PATH_VIEW = 'admin.ratings.';

    public function index()
    {
        $ratings = Rating::query()->with(['user', 'product', 'order'])->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('ratings'));
    }

    public function show($id)
    {
        $rating = Rating::query()->findOrFail($id);

        return view(self::PATH_VIEW . __FUNCTION__, compact('rating'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'is_show' => 'required'
        ]);

        $rating = Rating::findOrFail($id);
        $rating->update([
            'is_show' => $request->is_show
        ]);

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }
}
