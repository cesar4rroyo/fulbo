<?php

namespace App\Http\Controllers;

use App\Enums\MessageState;
use App\Support\SessionHelper;
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
        $tempat_penyewaans = TempatPenyewaan::query()
            ->isVerified()
            ->hasLocation()
            ->get();

        return $responseFactory->view("tempat-penyewaan-location.edit", compact(
            "tempat_penyewaan",
            "tempat_penyewaans",
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param TempatPenyewaan $tempat_penyewaan
     * @return Response
     */
    public function update(Request $request, ResponseFactory $responseFactory, TempatPenyewaan $tempat_penyewaan)
    {
        $data = $request->validate([
            "latitude" => ["required", "numeric"],
            "longitude" => ["required", "numeric"],
        ]);

        $tempat_penyewaan->update($data);
        SessionHelper::flashMessage(__("messages.update.success"), MessageState::STATE_SUCCESS);

        return $responseFactory->noContent(200);
    }
}
