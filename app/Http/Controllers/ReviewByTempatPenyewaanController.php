<?php

namespace App\Http\Controllers;

use App\Enums\MessageState;
use App\Providers\AuthServiceProvider;
use App\Review;
use App\Support\SessionHelper;
use App\TempatPenyewaan;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReviewByTempatPenyewaanController extends Controller
{
    private ResponseFactory $responseFactory;
    private Gate $gate;

    /**
     * FotoTempatPenyewaanController constructor.
     * @param ResponseFactory $responseFactory
     * @param Gate $gate
     */
    public function __construct(ResponseFactory $responseFactory, Gate $gate)
    {
        $this->responseFactory = $responseFactory;
        $this->gate = $gate;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\TempatPenyewaan  $tempatPenyewaan
     * @return \Illuminate\Http\Response
     */
    public function index(TempatPenyewaan $tempatPenyewaan)
    {
        $this->gate->authorize(AuthServiceProvider::ACTION_VIEW_ANY_TEMPAT_PENYEWAAN_REVIEW, $tempatPenyewaan);

        $reviews = $tempatPenyewaan->reviews()
            ->orderByDesc("created_at")
            ->paginate();

        return $this->responseFactory->view("review-by-tempat-penyewaan.index", [
                "tempat_penyewaan" => $tempatPenyewaan,
                "reviews" => $reviews,
            ]);
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
