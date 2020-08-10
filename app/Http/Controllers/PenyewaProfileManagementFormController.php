<?php

namespace App\Http\Controllers;

use App\Providers\AuthServiceProvider;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PenyewaProfileManagementFormController extends Controller
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
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Response
     * @throws AuthorizationException
     */
    public function __invoke(Request $request)
    {
        $this->gate->authorize(AuthServiceProvider::ACTION_MANAGE_PENYEWA_PROFILE);

        return $this->responseFactory
            ->view("penyewa-profile-management", [
                "user" => auth()->user()
            ]);
    }
}
