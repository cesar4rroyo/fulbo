<?php

namespace App\Http\Controllers;

use App\Enums\MessageState;
use App\Enums\UserLevel;
use App\Support\SessionHelper;
use App\TempatPenyewaan;
use App\User;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Validation\Factory as ValidatorFactory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
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
     * @param ValidatorFactory $validatorFactory
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, ValidatorFactory $validatorFactory)
    {
        $data = $validatorFactory->make($request->all(), [
            "nama" => ["required", "string", Rule::unique(TempatPenyewaan::class)],
            "alamat" => ["required", "string"],
            "name" => ["required", "string"],
            "no_telepon" => ["required", "string", Rule::unique(TempatPenyewaan::class)],
            "email" => ["required", "string", Rule::unique(User::class)],
            "tanggal_lahir" => ["required", "dateformat:Y-m-d"],
            "password" => ["required", "string", "confirmed"],
            "waktu_buka" => ["required", "date_format:H:i"],
            "waktu_tutup" => ["required", "date_format:H:i"],
        ])->after(function (Validator $validator) {
            $data = $validator->validated();
            $waktuBuka = Date::createFromFormat("H:i", $data["waktu_buka"]);
            $waktuTutup = Date::createFromFormat("H:i", $data["waktu_tutup"]);

            if ($waktuBuka->greaterThanOrEqualTo($waktuTutup)) {
                $validator->errors()->add(
                    "waktu_buka", "Waktu buka wajib < waktu tutup."
                );
            }
        })->validate();

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
