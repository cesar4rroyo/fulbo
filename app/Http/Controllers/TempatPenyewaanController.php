<?php

namespace App\Http\Controllers;

use App\Providers\AuthServiceProvider;
use App\TempatPenyewaan;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;

class TempatPenyewaanController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            "auth",
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize(AuthServiceProvider::ACTION_VIEW_ANY, TempatPenyewaan::class);
        return response()->view("tempat-penyewaan.index");
    }
}
