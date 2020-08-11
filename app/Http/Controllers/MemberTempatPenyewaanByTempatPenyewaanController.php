<?php

namespace App\Http\Controllers;

use App\MemberTempatPenyewaan;
use App\TempatPenyewaan;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MemberTempatPenyewaanByTempatPenyewaanController extends Controller
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
       return $this->responseFactory
            ->view("member-tempat-penyewaan-by-tempat-penyewaan.index", [
                "tempat_penyewaan" => $tempatPenyewaan,
                "members" => $tempatPenyewaan->members()
                    ->with("user")
                    ->orderBy('id')
                    ->paginate(),
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param TempatPenyewaan $tempatPenyewaan
     * @return Response
     */
    public function create(TempatPenyewaan $tempatPenyewaan)
    {
        return $this->responseFactory->view("member-tempat-penyewaan-by-tempat-penyewaan.create", [
            "tempat_penyewaan" => $tempatPenyewaan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TempatPenyewaan $tempatPenyewaan
     * @param MemberTempatPenyewaan $memberTempatPenyewaan
     * @return Response
     */
    public function edit( MemberTempatPenyewaan $memberTempatPenyewaan)
    {
        return $this->responseFactory->view("member-tempat-penyewaan-by-tempat-penyewaan.edit", [
            "member_tempat_penyewaan" => $memberTempatPenyewaan,
        ]);
    }
}
