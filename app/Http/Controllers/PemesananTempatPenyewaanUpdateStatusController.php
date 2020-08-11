<?php

namespace App\Http\Controllers;

use App\Enums\MessageState;
use App\Enums\PemesananStatus;
use App\Pemesanan;
use App\Providers\AuthServiceProvider;
use App\Support\SessionHelper;
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

        SessionHelper::flashMessage(
            __("messages.update.success"),
            MessageState::STATE_SUCCESS,
        );

        return $this->responseFactory
            ->redirectToRoute(
                "pemesanan-by-tempat.show",
                $pemesanan
            );
    }
}
