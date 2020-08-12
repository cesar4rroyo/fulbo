<?php

namespace App\Http\Controllers;

use App\MemberTempatPenyewaan;
use App\Pemesanan;
use App\Providers\AuthServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PemesananByMemberTempatPenyewaan extends Controller
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
     * @param MemberTempatPenyewaan $memberTempatPenyewaan
     * @return Response
     */
    public function index(MemberTempatPenyewaan $memberTempatPenyewaan)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param MemberTempatPenyewaan $memberTempatPenyewaan
     * @return Response
     */
    public function create(MemberTempatPenyewaan $memberTempatPenyewaan)
    {
        $this->gate->authorize(
            AuthServiceProvider::ACTION_CREATE_PEMESANAN_MEMBER,
            $memberTempatPenyewaan
        );

        return $this->responseFactory->view("pemesanan-by-member-tempat-penyewaan.create", [
            "member_tempat_penyewaan" => $memberTempatPenyewaan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param MemberTempatPenyewaan $memberTempatPenyewaan
     * @return Response
     */
    public function store(Request $request, MemberTempatPenyewaan $memberTempatPenyewaan)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param MemberTempatPenyewaan $memberTempatPenyewaan
     * @param Pemesanan $pemesanan
     * @return Response
     */
    public function show(MemberTempatPenyewaan $memberTempatPenyewaan, Pemesanan $pemesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param MemberTempatPenyewaan $memberTempatPenyewaan
     * @param Pemesanan $pemesanan
     * @return Response
     */
    public function edit(MemberTempatPenyewaan $memberTempatPenyewaan, Pemesanan $pemesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param MemberTempatPenyewaan $memberTempatPenyewaan
     * @param Pemesanan $pemesanan
     * @return Response
     */
    public function update(Request $request, MemberTempatPenyewaan $memberTempatPenyewaan, Pemesanan $pemesanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MemberTempatPenyewaan $memberTempatPenyewaan
     * @param Pemesanan $pemesanan
     * @return Response
     */
    public function destroy(MemberTempatPenyewaan $memberTempatPenyewaan, Pemesanan $pemesanan)
    {
        //
    }
}
