<?php

namespace App\Http\Controllers;

use App\TempatPenyewaan;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class GuestTempatPenyewaanIndexController extends Controller
{
    private ResponseFactory $responseFactory;

    /**
     * GuestTempatPenyewaanIndexController constructor.
     * @param ResponseFactory $responseFactory
     */
    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return $this->responseFactory->view("guest-tempat-penyewaan-index", [
            "column_amount" => 3,
            "tempat_penyewaans" => TempatPenyewaan::query()
                ->orderBy("nama")
                ->paginate(9)
        ]);
    }
}
