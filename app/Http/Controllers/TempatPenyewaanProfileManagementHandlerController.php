<?php

namespace App\Http\Controllers;

use App\Enums\MessageState;
use App\Providers\AuthServiceProvider;
use App\TempatPenyewaan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TempatPenyewaanProfileManagementHandlerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $this->authorize(AuthServiceProvider::ACTION_MANAGE_TEMPAT_PENYEWAAN_PROFILE);

        /** @var User $user */
        $user = auth()->user();

        $data = $request->validate([
            "nama" => ["required", "string", Rule::unique(TempatPenyewaan::class)->ignoreModel($user->tempat_penyewaan)],
            "alamat" => ["required", "string"],
            "name" => ["required", "string"],
            "email" => ["required", "string", Rule::unique(User::class)->ignoreModel($user)],
            "tanggal_lahir" => ["required", "dateformat:Y-m-d"],
            "password" => ["nullable", "string", "confirmed"],
        ]);

        $tempatPenyewaanData = Arr::only($data, ["nama", "alamat"]);
        $userData = Arr::only($data, ["name", "email", "tanggal_lahir", "password"]);
        if (isset($userData["password"])) {
            $userData["password"] = Hash::make($userData["password"]);
        }
        else {
            unset($userData["password"]);
        }

        DB::beginTransaction();
        $user->tempat_penyewaan->update($tempatPenyewaanData);
        $user->update($userData);
        DB::commit();

        return redirect()->back()
            ->with("messages", [
                [
                    "content" => __("messages.update.success"),
                    "state" => MessageState::STATE_SUCCESS
                ]
            ]);
    }
}
