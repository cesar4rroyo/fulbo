<?php

namespace App\Http\Controllers;

use App\Pemesanan;
use App\Providers\AuthServiceProvider;
use App\TempatPenyewaan;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TempatPenyewaanPemesananPenyewaController extends Controller
{
    private Gate $gate;
    private ResponseFactory $responseFactory;

    /**
     * PemesananController constructor.
     * @param Gate $gate
     * @param ResponseFactory $responseFactory
     */
    public function __construct(Gate $gate, ResponseFactory $responseFactory)
    {
        $this->gate = $gate;
        $this->responseFactory = $responseFactory;

        $this->middleware([
            "auth"
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param TempatPenyewaan $tempatPenyewaan
     * @return Response
     */
    public function create(TempatPenyewaan $tempatPenyewaan)
    {
        $this->gate->authorize(AuthServiceProvider::ACTION_CREATE_PEMESANAN_PENYEWA);

        return $this->responseFactory->view("pemesanan-penyewa.create", [
            "tempat_penyewaan" => $tempatPenyewaan,
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param Pemesanan $pemesanan
     * @return Response
     */
    public function show(Pemesanan $pemesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Pemesanan $pemesanan
     * @return Response
     */
    public function edit(Pemesanan $pemesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Pemesanan $pemesanan
     * @return Response
     */
    public function update(Request $request, Pemesanan $pemesanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Pemesanan $pemesanan
     * @return Response
     */
    public function destroy(Pemesanan $pemesanan)
    {
        //
    }
}
