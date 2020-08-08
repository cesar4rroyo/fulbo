<?php

namespace App\Http\Controllers;

use App\Enums\MessageState;
use App\Enums\UserLevel;
use App\Penyewa;
use App\Providers\RouteServiceProvider;
use App\Support\SessionHelper;
use App\User;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PenyewaRegistrationHandlerController extends Controller
{
    private ResponseFactory $responseFactory;

    /**
     * PenyewaRegistrationHandlerController constructor.
     * @param ResponseFactory $responseFactory
     */
    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            "name" => ["required", "string"],
            "no_telepon" => ["required", "string", Rule::unique(Penyewa::class)],
            "email" => ["required", "string", Rule::unique(User::class)],
            "tanggal_lahir" => ["required", "dateformat:Y-m-d"],
            "password" => ["required", "string", "confirmed"],
        ]);


        $data["password"] = Hash::make($data["password"]);

        $user = User::query()->create(array_merge(Arr::only($data, [
            "name",
            "email",
            "tanggal_lahir",
            "password",
        ]), [
            "level" => UserLevel::PENYEWA,
        ]));

        Penyewa::query()->create([
            "no_telepon" => $data["no_telepon"],
            "user_id" => $user->id,
        ]);

        Auth::guard()->login($user);

        SessionHelper::flashMessage(
            __("messages.penyewa-registration-success"),
            MessageState::STATE_SUCCESS
        );

        return $this->responseFactory->redirectTo(RouteServiceProvider::defaultRoute($user));
    }
}
