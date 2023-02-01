<?php

namespace App\Http\Controllers;

use App\FotoTempatPenyewaan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

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
     * @return Response|BinaryFileResponse
     */
    public function __invoke(Request $request, FotoTempatPenyewaan $foto)
    {
        try {
            return $this->responseFactory->file(
                $foto->getCarouselPath()
            );
        } catch (FileNotFoundException $exception) {
            return $this->responseFactory
                ->noContent(400);
        }
    }
}