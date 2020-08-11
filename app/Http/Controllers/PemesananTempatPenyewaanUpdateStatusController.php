<?php

namespace App\Http\Controllers;

use App\Enums\PemesananStatus;
use App\Pemesanan;
use App\Providers\AuthServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Validation\Rule;

class PemesananTempatPenyewaanUpdateStatusController extends Controller
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
     * Handle the incoming request.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function __invoke(Request $request, Pemesanan $pemesanan)
    {
        $this->gate->authorize(AuthServiceProvider::ACTION_MANAGE_PEMESANAN_PENYEWAAN);

        $data = $request->validate([
            "status" => ["required", Rule::in([
                PemesananStatus::BATAL,
                PemesananStatus::DRAFT,
                PemesananStatus::DITERIMA,
            ])],
        ]);

        $pemesanan->update($data);

        return $this->responseFactory
            ->redirectToRoute(
                "tempat-penyewaan.pemesanan-by-tempat.index",
                $pemesanan->tempat_penyewaan_id
            );
    }
}
