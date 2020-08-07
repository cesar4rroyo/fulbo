<?php

namespace App\Http\Controllers;

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
     */
    public function __invoke(Request $request, TempatPenyewaan $tempat_penyewaan)
    {
        $tempat_penyewaan->load([
            "fotos",
            "lapangans",
            "admin",
            "sesi_pemesanans",
        ]);

        return $this->responseFactory->view("tempat-penyewaan.page.show", compact(
            "tempat_penyewaan"
        ));
    }
}
