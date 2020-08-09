<?php

namespace App\Http\Controllers;

use App\Enums\MessageState;
use App\HargaPemesanan;
use App\Support\SessionHelper;
use App\TempatPenyewaan;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TempatPenyewaanHargaPemesananController extends Controller
{
    /**
     * @var ResponseFactory
     */
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
     * @param TempatPenyewaan $tempatPenyewaan
     * @return Response
     */
    public function index(TempatPenyewaan $tempatPenyewaan)
    {
        return $this->responseFactory->view("tempat-penyewaan.harga-pemesanan.index", [
            "harga_pemesanans" => $tempatPenyewaan->harga_pemesanans()->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param HargaPemesanan $hargaPemesanan
     * @return Response
     */
    public function edit(HargaPemesanan $hargaPemesanan)
    {
        return $this->responseFactory->view("tempat-penyewaan.harga-pemesanan.edit", [
            "harga_pemesanan" => $hargaPemesanan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param TempatPenyewaan $tempatPenyewaan
     * @param HargaPemesanan $hargaPemesanan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, TempatPenyewaan $tempatPenyewaan, HargaPemesanan $hargaPemesanan)
    {
        $data = $request->validate([
            "harga" => ["required", "numeric", "gte:0"],
        ]);

        $hargaPemesanan->update(
            $data
        );

        SessionHelper::flashMessage(
            __("messages.update.success"),
            MessageState::STATE_SUCCESS
        );

        return $this->responseFactory->redirectToRoute(
            "harga-pemesanan.edit",
            $hargaPemesanan
        );
    }

}
