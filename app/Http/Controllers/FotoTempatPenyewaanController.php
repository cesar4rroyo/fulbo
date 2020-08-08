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
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

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
     * @throws AuthorizationException
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
     * @throws AuthorizationException
     */
    public function create(TempatPenyewaan $tempat_penyewaan)
    {
        $this->gate->authorize(AuthServiceProvider::ACTION_MANAGE_FOTO);

        return $this->responseFactory->view("tempat-penyewaan.foto.create", compact(
            "tempat_penyewaan"
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param TempatPenyewaan $tempat_penyewaan
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(Request $request, TempatPenyewaan $tempat_penyewaan)
    {
        $this->gate->authorize(AuthServiceProvider::ACTION_MANAGE_FOTO);

        $data = $request->validate([
            "nama" => ["required", "string"],
            "deskripsi" => ["required", "string"],
            "urutan" => ["required", "numeric"],
            "image" => ["required", "file", "mimes:jpg,png,jpeg"],
        ]);

        unset($data["image"]);

        DB::beginTransaction();

        /** @var Foto $foto */
        $foto = $tempat_penyewaan->fotos()->create($data);
        $foto->addMediaFromRequest("image")
            ->toMediaCollection();

        DB::commit();

        SessionHelper::flashMessage(
            __("messages.create.success"),
            MessageState::STATE_SUCCESS
        );

        return $this->responseFactory->redirectToRoute("tempat-penyewaan.foto.index",
            $tempat_penyewaan
        );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Foto $foto
     * @return Response
     * @throws AuthorizationException
     */
    public function edit(Foto $foto)
    {
        $this->gate->authorize(AuthServiceProvider::ACTION_MANAGE_FOTO);
        return $this->responseFactory->view("tempat-penyewaan.foto.edit", compact("foto"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Foto $foto
     * @return RedirectResponse
     * @throws AuthorizationException
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(Request $request, Foto $foto)
    {
        $this->gate->authorize(AuthServiceProvider::ACTION_MANAGE_FOTO);

        $data = $request->validate([
            "nama" => ["required", "string"],
            "deskripsi" => ["required", "string"],
            "image" => ["nullable", "file", "mimes:jpg,png,jpeg"]
        ]);

        DB::beginTransaction();

        if ($request->hasFile("image")) {
            $foto
                ->clearMediaCollection()
                ->addMediaFromRequest("image")
                ->toMediaCollection();
        }
        unset($data["image"]);

        $foto->update($data);

        DB::commit();

        SessionHelper::flashMessage(
            __("messages.update.success"),
            MessageState::STATE_SUCCESS,
        );

        return $this->responseFactory->redirectToRoute(
            "foto.edit",
            $foto
        );
    }

    /**
     * Remove the specified resource from storage.
     *
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
