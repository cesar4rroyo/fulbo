<?php

namespace App\Http\Controllers;

use App\Pemesanan;
use App\TempatPenyewaan;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * Display the specified resource.
     *
     * @param  \App\TempatPenyewaan  $tempatPenyewaan
     * @param  \App\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function show(Pemesanan $pemesanan)
    {
        $pemesanan->load([
            "tempat_penyewaan",
            "penyewa",
            "items" => function (HasMany $builder) {
                $builder->orderBy("waktu_mulai");
            }
        ]);

        return $this->responseFactory->view("tempat-penyewaan.pemesanan.show", [
            "pemesanan" => $pemesanan
        ]);
    }
}
