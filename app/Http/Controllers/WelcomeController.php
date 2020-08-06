<?php

namespace App\Http\Controllers;

use App\TempatPenyewaan;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WelcomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request, ResponseFactory $responseFactory)
    {
        $tempatPenyewaans = TempatPenyewaan::query()
            ->isVerified()
            ->hasLocation()
            ->get();

        return $responseFactory->view("welcome", compact(
            "tempatPenyewaans"
        ));
    }
}
