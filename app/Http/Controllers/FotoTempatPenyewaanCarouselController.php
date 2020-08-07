<?php

namespace App\Http\Controllers;

use App\FotoTempatPenyewaan;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FotoTempatPenyewaanCarouselController extends Controller
{
    private ResponseFactory $responseFactory;

    /**
     * FotoTempatPenyewaanThumbController constructor.
     * @param ResponseFactory $responseFactory
     */
    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param FotoTempatPenyewaan $foto
     * @return BinaryFileResponse
     */
    public function __invoke(Request $request, FotoTempatPenyewaan $foto)
    {
        return $this->responseFactory->file(
            $foto->getCarouselPath()
        );
    }
}
