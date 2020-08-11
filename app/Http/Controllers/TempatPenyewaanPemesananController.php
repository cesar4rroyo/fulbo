<?php

namespace App\Http\Controllers;

use App\Pemesanan;
use App\TempatPenyewaan;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class TempatPenyewaanPemesananController extends Controller
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

        $this->middleware([
            "auth"
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\TempatPenyewaan  $tempatPenyewaan
     * @return \Illuminate\Http\Response
     */
    public function index(TempatPenyewaan $tempatPenyewaan)
    {
        $tempatPenyewaan->load([
            "pemesanans",
        ]);

        return $this->responseFactory->view("tempat-penyewaan.pemesanan.index", [
            "tempat_penyewaan" => $tempatPenyewaan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\TempatPenyewaan  $tempatPenyewaan
     * @return \Illuminate\Http\Response
     */
    public function create(TempatPenyewaan $tempatPenyewaan)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TempatPenyewaan  $tempatPenyewaan
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, TempatPenyewaan $tempatPenyewaan)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TempatPenyewaan  $tempatPenyewaan
     * @param  \App\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function show(TempatPenyewaan $tempatPenyewaan, Pemesanan $pemesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TempatPenyewaan  $tempatPenyewaan
     * @param  \App\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function edit(TempatPenyewaan $tempatPenyewaan, Pemesanan $pemesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TempatPenyewaan  $tempatPenyewaan
     * @param  \App\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TempatPenyewaan $tempatPenyewaan, Pemesanan $pemesanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TempatPenyewaan  $tempatPenyewaan
     * @param  \App\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(TempatPenyewaan $tempatPenyewaan, Pemesanan $pemesanan)
    {
        //
    }
}
