<?php

namespace App\Http\Controllers;

use App\Enums\MessageState;
use App\Review;
use App\Support\SessionHelper;
use App\TempatPenyewaan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReviewByTempatPenyewaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\TempatPenyewaan  $tempatPenyewaan
     * @return \Illuminate\Http\Response
     */
    public function index(TempatPenyewaan $tempatPenyewaan)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TempatPenyewaan  $tempatPenyewaan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, TempatPenyewaan $tempatPenyewaan)
    {
        $data = $request->validate([
            "rating" => ["required", Rule::in([1, 2, 3, 4, 5])],
            "konten" => ["required", "string"],
        ]);

        $tempatPenyewaan->reviews()->create(array_merge($data, [
            "penyewa_id" => auth()->user()->penyewa->id,
        ]));

        SessionHelper::flashMessage(
            __("messages.create.success"),
            MessageState::STATE_SUCCESS,
        );

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TempatPenyewaan  $tempatPenyewaan
     * @param  \App\Review  $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Review $review)
    {
        $review->forceDelete();

        SessionHelper::flashMessage(
            __("messages.delete.success"),
            MessageState::STATE_SUCCESS,
        );

        return back();
    }
}
