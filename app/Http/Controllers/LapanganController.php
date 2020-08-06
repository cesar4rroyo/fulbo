<?php

namespace App\Http\Controllers;

use App\Lapangan;
use App\TempatPenyewaan;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LapanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param TempatPenyewaan $tempatPenyewaan
     * @return Response
     */
    public function index(TempatPenyewaan $tempatPenyewaan, ResponseFactory $responseFactory)
    {
        return $responseFactory->view("tempat-penyewaan.lapangan.index", compact(
            "tempatPenyewaan"
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param TempatPenyewaan $tempatPenyewaan
     * @return Response
     */
    public function create(TempatPenyewaan $tempatPenyewaan)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param TempatPenyewaan $tempatPenyewaan
     * @return Response
     */
    public function store(Request $request, TempatPenyewaan $tempatPenyewaan)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param TempatPenyewaan $tempatPenyewaan
     * @param Lapangan $lapangan
     * @return Response
     */
    public function show(TempatPenyewaan $tempatPenyewaan, Lapangan $lapangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TempatPenyewaan $tempatPenyewaan
     * @param Lapangan $lapangan
     * @return Response
     */
    public function edit(TempatPenyewaan $tempatPenyewaan, Lapangan $lapangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param TempatPenyewaan $tempatPenyewaan
     * @param Lapangan $lapangan
     * @return Response
     */
    public function update(Request $request, TempatPenyewaan $tempatPenyewaan, Lapangan $lapangan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TempatPenyewaan $tempatPenyewaan
     * @param Lapangan $lapangan
     * @return Response
     */
    public function destroy(TempatPenyewaan $tempatPenyewaan, Lapangan $lapangan)
    {
        //
    }
}
