<?php

namespace App\Http\Controllers;

use App\Pemesanan;
use App\Providers\AuthServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Response;

class PemesananPenyewaController extends Controller
{
    private Gate $gate;
    private ResponseFactory $responseFactory;

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
        $this->gate->authorize(AuthServiceProvider::ACTION_VIEW_ANY_PEMESANAN_PENYEWA);

        return $this->responseFactory->view(
            "pemesanan-penyewa.index"
        );
    }

    public function show(Pemesanan $pemesanan)
    {
        $pemesanan->load([
            "tempat_penyewaan",
            "penyewa",
            "items" => function (HasMany $builder) {
                $builder->orderBy("waktu_mulai");
            }
        ]);

        return $this->responseFactory->view("pemesanan-penyewa.show", [
            "pemesanan" => $pemesanan,
        ]);
    }
}
