<?php

namespace App\Http\Controllers;

use App\MemberTempatPenyewaan;
use App\Penyewa;
use App\Providers\AuthServiceProvider;
use App\TempatPenyewaan;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class TempatPenyewaanPageController extends Controller
{
    private Gate $gate;
    private ResponseFactory $responseFactory;

    /**
     * TempatPenyewaanPageController constructor.
     * @param Gate $gate
     * @param ResponseFactory $responseFactory
     */
    public function __construct(Gate $gate, ResponseFactory $responseFactory)
    {
        $this->gate = $gate;
        $this->responseFactory = $responseFactory;
    }

    /**
     * @param Request $request
     * @param TempatPenyewaan $tempat_penyewaan
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, TempatPenyewaan $tempat_penyewaan)
    {
        $this->gate->authorize(AuthServiceProvider::ACTION_VIEW_ANY_TEMPAT_PENYEWAAN_PAGE);

        $tempat_penyewaan->load([
            "fotos",
            "lapangans",
            "admin",
            "sesi_pemesanans",
        ]);

        return $this->responseFactory->view("tempat-penyewaan.page.show", [
            "tempat_penyewaan" => $tempat_penyewaan,
            "averageRating" => $tempat_penyewaan->reviews()->avg("rating"),
            "review" => $tempat_penyewaan->reviews()
                ->where([
                    "penyewa_id" => $request->user()->penyewa->id,
                ])
                ->first(),

            "membership" => MemberTempatPenyewaan::query()
                ->where([
                    "penyewa_id" => $request->user()->penyewa->id ?? null,
                    "tempat_penyewaan_id" => $tempat_penyewaan->id,
                ])->first(),
        ]);
    }
}
