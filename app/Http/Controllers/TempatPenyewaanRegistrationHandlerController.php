<?php

namespace App\Http\Controllers;

use App\Enums\MessageState;
use App\Enums\UserLevel;
use App\Support\SessionHelper;
use App\TempatPenyewaan;
use App\User;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TempatPenyewaanRegistrationHandlerController extends Controller
{
    private ResponseFactory $responseFactory;

    /**
     * TempatPenyewaanRegistrationHandlerController constructor.
     * @param ResponseFactory $responseFactory
     */
    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            "nama" => ["required", "string", Rule::unique(TempatPenyewaan::class)],
            "alamat" => ["required", "string"],
            "name" => ["required", "string"],
            "no_telepon" => ["required", "string", Rule::unique(TempatPenyewaan::class)],
            "email" => ["required", "string", Rule::unique(User::class)],
            "tanggal_lahir" => ["required", "dateformat:Y-m-d"],
            "password" => ["required", "string", "confirmed"],
        ]);

        DB::beginTransaction();

        $data["password"] = Hash::make($data["password"]);
        $data["level"] = UserLevel::ADMIN_PENYEWAAN;

        $user = User::query()->create(Arr::only($data, [
            "name",
            "email",
            "tanggal_lahir",
            "password",
            "level",
        ]));

        $data["waktu_buka"] = "10:00:00";
        $data["waktu_tutup"] = "22:00:00";

        TempatPenyewaan::query()->create(array_merge(Arr::only($data, [
            "nama",
            "alamat",
            "no_telepon",
            "waktu_buka",
            "waktu_tutup",
        ]), [
            "admin_id" => $user->id,
        ]));

        DB::commit();

        Auth::guard()->login($user);

        SessionHelper::flashMessage(
            __("messages.tempat-penyewaan-registration-success"),
            MessageState::STATE_SUCCESS
        );

        return $this->responseFactory
            ->redirectToRoute("tempat-penyewaan-profile-management");
    }
}
