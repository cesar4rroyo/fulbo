<?php

namespace App\Http\Controllers;

use App\TempatPenyewaan;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TempatPenyewaanLocationController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param TempatPenyewaan $tempat_penyewaan
     * @param ResponseFactory $responseFactory
     * @return Response
     */
    public function edit(TempatPenyewaan $tempat_penyewaan, ResponseFactory $responseFactory)
    {
        return $responseFactory->view("tempat-penyewaan-location.edit", compact(
            "tempat_penyewaan"
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param TempatPenyewaan $tempat_penyewaan
     * @return Response
     */
    public function update(Request $request, TempatPenyewaan $tempat_penyewaan)
    {
        //
    }
}
