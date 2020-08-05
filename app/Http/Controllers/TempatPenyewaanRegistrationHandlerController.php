<?php

namespace App\Http\Controllers;

use App\Enums\UserLevel;
use App\Providers\AuthServiceProvider;
use App\TempatPenyewaan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TempatPenyewaanRegistrationHandlerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            "nama" => ["required", "string", Rule::unique(TempatPenyewaan::class)],
            "alamat" => ["required", "string"],
            "name" => ["required", "string"],
            "email" => ["required", "string", Rule::unique(User::class)],
            "tanggal_lahir" => ["required", "dateformat:Y-m-d"],
            "password" => ["required", "string", "confirmed"],
        ]);

        DB::beginTransaction();

        $data["password"] = Hash::make("password");
        $data["level"] = UserLevel::ADMIN_PENYEWA;

        $user = User::query()->create(Arr::only($data, [
            "name",
            "email",
            "tanggal_lahir",
            "password",
            "level",
        ]));

        TempatPenyewaan::query()->create(array_merge(Arr::only($data, [
            "nama",
            "alamat"
        ]), [
            "admin_id" => $user->id,
        ]));

        DB::commit();

        Auth::guard()->login($user);

        return redirect()->route("tempat-penyewaan-profile-management");
    }
}
