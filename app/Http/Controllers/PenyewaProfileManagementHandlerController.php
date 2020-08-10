<?php

namespace App\Http\Controllers;

use App\Enums\MessageState;
use App\Penyewa;
use App\Providers\AuthServiceProvider;
use App\Support\SessionHelper;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PenyewaProfileManagementHandlerController extends Controller
{
    private Gate $gate;
    private ResponseFactory $responseFactory;

    /**
     * PenyewaProfileManagementHandlerController constructor.
     * @param Gate $gate
     * @param ResponseFactory $responseFactory
     */
    public function __construct(Gate $gate, ResponseFactory $responseFactory)
    {
        $this->gate = $gate;
        $this->responseFactory = $responseFactory;
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return RedirectResponse|Response
     * @throws AuthorizationException
     */
    public function __invoke(Request $request)
    {
        $this->gate->authorize(AuthServiceProvider::ACTION_MANAGE_PENYEWA_PROFILE);

        /** @var User $user */
        $user = Auth::user();

        $data = $request->validate([
            "name" => ["required", "string"],
            "email" => ["required", "string", Rule::unique(User::class)->ignoreModel($user)],
            "no_telepon" => ["required", "string", Rule::unique(Penyewa::class)->ignoreModel($user->penyewa)],
            "tanggal_lahir" => ["required", "dateformat:Y-m-d"],
            "password" => ["nullable", "string", "confirmed"],
        ]);

        if (isset($data["password"])) {
            $data["password"] = Hash::make($data["password"]);
        } else {
            unset($data["password"]);
        }

        DB::transaction(function () use ($user, $data) {
            $user->penyewa()->update(Arr::only($data, [
                "no_telepon"
            ]));

            $user->update(Arr::only($data, [
                "name",
                "email",
                "tanggal_lahir",
                "password",
            ]));
        });

        SessionHelper::flashMessage(
            __("messages.update.success"),
            MessageState::STATE_SUCCESS,
        );

        return $this->responseFactory->redirectToRoute(
            "penyewa-profile-management"
        );
    }
}
