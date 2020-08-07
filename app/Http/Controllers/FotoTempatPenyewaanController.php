<?php

namespace App\Http\Controllers;

use App\Enums\MessageState;
use App\FotoTempatPenyewaan as Foto;
use App\Providers\AuthServiceProvider;
use App\Support\SessionHelper;
use App\TempatPenyewaan;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

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
     * @param TempatPenyewaan $tempat_penyewaan
     * @return Response
     */
    public function index(TempatPenyewaan $tempat_penyewaan)
    {
        $this->gate->authorize(AuthServiceProvider::ACTION_MANAGE_FOTO);

        $fotos = $tempat_penyewaan->fotos()
            ->with("media")
            ->paginate();

        return $this->responseFactory->view("tempat-penyewaan.foto.index", compact(
            "fotos",
            "tempat_penyewaan"
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param TempatPenyewaan $tempat_penyewaan
     * @return Response
     */
    public function create(TempatPenyewaan $tempat_penyewaan)
    {
        $this->gate->authorize(AuthServiceProvider::ACTION_MANAGE_FOTO);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param TempatPenyewaan $tempat_penyewaan
     * @return Response
     */
    public function store(Request $request, TempatPenyewaan $tempat_penyewaan)
    {
        $this->gate->authorize(AuthServiceProvider::ACTION_MANAGE_FOTO);
    }

    /**
     * Display the specified resource.
     *
     * @param TempatPenyewaan $tempat_penyewaan
     * @param Foto $foto
     * @return Response
     */
    public function show(TempatPenyewaan $tempat_penyewaan, Foto $foto)
    {
        $this->gate->authorize(AuthServiceProvider::ACTION_MANAGE_FOTO);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TempatPenyewaan $tempat_penyewaan
     * @param Foto $foto
     * @return Response
     */
    public function edit(TempatPenyewaan $tempat_penyewaan, Foto $foto)
    {
        $this->gate->authorize(AuthServiceProvider::ACTION_MANAGE_FOTO);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param TempatPenyewaan $tempat_penyewaan
     * @param Foto $foto
     * @return Response
     */
    public function update(Request $request, TempatPenyewaan $tempat_penyewaan, Foto $foto)
    {
        $this->gate->authorize(AuthServiceProvider::ACTION_MANAGE_FOTO);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TempatPenyewaan $tempat_penyewaan
     * @param Foto $foto
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Foto $foto)
    {
        $this->gate->authorize(AuthServiceProvider::ACTION_MANAGE_FOTO);

        // Save it so we can use it to redirect to the index page
        $tempatPenyewaanId = $foto->tempat_penyewaan_id;

        DB::transaction(function () use ($foto) {
            $foto->delete();
        });

        SessionHelper::flashMessage(
            __("messages.delete.success"),
            MessageState::STATE_SUCCESS,
        );

        return $this->responseFactory
            ->redirectToRoute("tempat-penyewaan.foto.index", $tempatPenyewaanId);
    }
}
