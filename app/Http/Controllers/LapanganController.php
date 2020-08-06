<?php

namespace App\Http\Controllers;

use App\Enums\MessageState;
use App\Lapangan;
use App\Providers\AuthServiceProvider;
use App\Support\SessionHelper;
use App\TempatPenyewaan;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LapanganController extends Controller
{
    private Gate $gate;
    private ResponseFactory $responseFactory;

    public function __construct(Gate $gate, ResponseFactory $responseFactory)
    {
        $this->gate = $gate;
        $this->responseFactory = $responseFactory;
    }

    /**
     * Display a listing of the resource.
     *
     * @param TempatPenyewaan $tempatPenyewaan
     * @return Response
     * @throws AuthorizationException
     */
    public function index(TempatPenyewaan $tempatPenyewaan)
    {
        $this->gate->authorize(AuthServiceProvider::ACTION_MANAGE_LAPANGAN);

        return $this->responseFactory->view("tempat-penyewaan.lapangan.index", compact(
            "tempatPenyewaan"
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param TempatPenyewaan $tempatPenyewaan
     * @return Response
     */
    public function create(TempatPenyewaan $tempatPenyewaan)
    {
        $this->gate->authorize(AuthServiceProvider::ACTION_MANAGE_LAPANGAN);

        return $this->responseFactory->view("tempat-penyewaan.lapangan.create", compact(
            "tempatPenyewaan"
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param TempatPenyewaan $tempatPenyewaan
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(Request $request, TempatPenyewaan $tempatPenyewaan)
    {
        $this->gate->authorize(AuthServiceProvider::ACTION_MANAGE_LAPANGAN);

        $data = $request->validate([
            "nama" => ["required", "string"],
            "aktif" => ["required", "boolean"],
        ]);

        $tempatPenyewaan->lapangans()->create($data);

        SessionHelper::flashMessage(
            __("messages.create.success"),
            MessageState::STATE_SUCCESS,
        );

        return $this->responseFactory
            ->redirectToRoute("tempat-penyewaan.lapangan.index", $tempatPenyewaan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TempatPenyewaan $tempatPenyewaan
     * @param Lapangan $lapangan
     * @return Response
     */
    public function edit(Lapangan $lapangan)
    {
        $this->gate->authorize(AuthServiceProvider::ACTION_MANAGE_LAPANGAN);

        return $this->responseFactory->view("tempat-penyewaan.lapangan.edit", compact(
            "lapangan",
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param TempatPenyewaan $tempatPenyewaan
     * @param Lapangan $lapangan
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, Lapangan $lapangan)
    {
        $this->gate->authorize(AuthServiceProvider::ACTION_MANAGE_LAPANGAN);

        $data = $request->validate([
            "nama" => ["required", "string"],
            "aktif" => ["required", "boolean"],
        ]);

        $lapangan->update($data);

        SessionHelper::flashMessage(
            __("messages.update.success"),
            MessageState::STATE_SUCCESS,
        );

        return $this->responseFactory->redirectToRoute(
            "lapangan.edit",
            $lapangan,
        );
    }
}
