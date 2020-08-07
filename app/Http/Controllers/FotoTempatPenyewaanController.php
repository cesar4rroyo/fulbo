<?php

namespace App\Http\Controllers;

use App\FotoTempatPenyewaan as Foto;
use App\Providers\AuthServiceProvider;
use App\TempatPenyewaan;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FotoTempatPenyewaanController extends Controller
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
    }

    /**
     * Display a listing of the resource.
     *
     * @param TempatPenyewaan $tempatPenyewaan
     * @return Response
     */
    public function index(TempatPenyewaan $tempatPenyewaan)
    {
        $this->gate->authorize(AuthServiceProvider::ACTION_MANAGE_FOTO);

        $fotos = $tempatPenyewaan->fotos()
            ->with("media")
            ->paginate();

        return $this->responseFactory->view("tempat-penyewaan.foto.index", compact(
            "fotos",
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
        $this->gate->authorize(AuthServiceProvider::ACTION_MANAGE_FOTO);
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
        $this->gate->authorize(AuthServiceProvider::ACTION_MANAGE_FOTO);
    }

    /**
     * Display the specified resource.
     *
     * @param TempatPenyewaan $tempatPenyewaan
     * @param Foto $foto
     * @return Response
     */
    public function show(TempatPenyewaan $tempatPenyewaan, Foto $foto)
    {
        $this->gate->authorize(AuthServiceProvider::ACTION_MANAGE_FOTO);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TempatPenyewaan $tempatPenyewaan
     * @param Foto $foto
     * @return Response
     */
    public function edit(TempatPenyewaan $tempatPenyewaan, Foto $foto)
    {
        $this->gate->authorize(AuthServiceProvider::ACTION_MANAGE_FOTO);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param TempatPenyewaan $tempatPenyewaan
     * @param Foto $foto
     * @return Response
     */
    public function update(Request $request, TempatPenyewaan $tempatPenyewaan, Foto $foto)
    {
        $this->gate->authorize(AuthServiceProvider::ACTION_MANAGE_FOTO);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TempatPenyewaan $tempatPenyewaan
     * @param Foto $foto
     * @return Response
     */
    public function destroy(TempatPenyewaan $tempatPenyewaan, Foto $foto)
    {
        $this->gate->authorize(AuthServiceProvider::ACTION_MANAGE_FOTO);
    }
}
