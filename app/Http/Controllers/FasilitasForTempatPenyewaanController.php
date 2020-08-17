<?php

namespace App\Http\Controllers;

use App\Enums\MessageState;
use App\Fasilitas;
use App\Providers\AuthServiceProvider;
use App\Support\SessionHelper;
use App\TempatPenyewaan;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FasilitasForTempatPenyewaanController extends Controller
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {

        $this->responseFactory = $responseFactory;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\TempatPenyewaan  $tempatPenyewaan
     * @return \Illuminate\Http\Response
     */
    public function index($tempatPenyewaan)
    {
        $this->authorize(AuthServiceProvider::ACTION_MANAGE_FASILITAS_TEMPAT_PENYEWAAN);

        return $this->responseFactory->view("fasilitas-for-tempat-penyewaan.index", [
            "tempat_penyewaan_id" => $tempatPenyewaan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\TempatPenyewaan  $tempatPenyewaan
     * @return \Illuminate\Http\Response
     */
    public function create(TempatPenyewaan $tempatPenyewaan)
    {
        $this->authorize(AuthServiceProvider::ACTION_MANAGE_FASILITAS_TEMPAT_PENYEWAAN);

        return $this->responseFactory->view("fasilitas-for-tempat-penyewaan.create", [
            "tempat_penyewaan" => $tempatPenyewaan,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TempatPenyewaan  $tempatPenyewaan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, TempatPenyewaan $tempatPenyewaan)
    {
        $this->authorize(AuthServiceProvider::ACTION_MANAGE_FASILITAS_TEMPAT_PENYEWAAN);

        $data = $request->validate([
            "nama" => [
                "required",
                "string",
                Rule::unique(Fasilitas::class)
                    ->where(function (Builder $builder) use ($tempatPenyewaan) {
                        $builder->where("tempat_penyewaan_id", $tempatPenyewaan->id);
                    })
            ]
        ]);

        $tempatPenyewaan->fasilitas()->create($data);

        SessionHelper::flashMessage(
            __("messages.create.success"),
            MessageState::STATE_SUCCESS,
        );

        return $this->responseFactory
            ->redirectToRoute("tempat-penyewaan.fasilitas-for-tempat-penyewaan.index", $tempatPenyewaan->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TempatPenyewaan  $tempatPenyewaan
     * @param  \App\Fasilitas  $fasilitas
     * @return \Illuminate\Http\Response
     */
    public function show(TempatPenyewaan $tempatPenyewaan, Fasilitas $fasilitas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TempatPenyewaan  $tempatPenyewaan
     * @param  \App\Fasilitas  $fasilitas
     * @return \Illuminate\Http\Response
     */
    public function edit(TempatPenyewaan $tempatPenyewaan, Fasilitas $fasilitas)
    {
        $this->authorize(AuthServiceProvider::ACTION_MANAGE_FASILITAS_TEMPAT_PENYEWAAN);

        return $this->responseFactory->view("fasilitas-for-tempat-penyewaan.edit", [
            "tempat_penyewaan" => $tempatPenyewaan,
            "fasilitas" => $fasilitas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TempatPenyewaan  $tempatPenyewaan
     * @param  \App\Fasilitas  $fasilitas
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, TempatPenyewaan $tempatPenyewaan, Fasilitas $fasilitas)
    {
        $this->authorize(AuthServiceProvider::ACTION_MANAGE_FASILITAS_TEMPAT_PENYEWAAN);

        $data = $request->validate([
            "nama" => [
                "required",
                "string",
                Rule::unique(Fasilitas::class)
                    ->where(function (Builder $builder) use ($tempatPenyewaan) {
                        $builder->where("tempat_penyewaan_id", $tempatPenyewaan->id);
                    })->ignoreModel($fasilitas)
            ]
        ]);

        $fasilitas->update($data);

        SessionHelper::flashMessage(
            __("messages.update.success"),
            MessageState::STATE_SUCCESS,
        );

        return $this->responseFactory->redirectToRoute("tempat-penyewaan.fasilitas-for-tempat-penyewaan.edit", [
            $tempatPenyewaan,
            $fasilitas,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TempatPenyewaan  $tempatPenyewaan
     * @param  \App\Fasilitas  $fasilitas
     * @return \Illuminate\Http\Response
     */
    public function destroy(TempatPenyewaan $tempatPenyewaan, Fasilitas $fasilitas)
    {
        //
    }
}
