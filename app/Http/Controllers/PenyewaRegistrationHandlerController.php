<?php

namespace App\Http\Controllers;

use App\Enums\UserLevel;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PenyewaRegistrationHandlerController extends Controller
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
            "name" => ["required", "string"],
            "username" => ["required", "string", Rule::unique(User::class)],
            "tanggal_lahir" => ["required", "dateformat:Y-m-d"],
            "password" => ["required", "string", "confirmed"],
        ]);

        $data["password"] = Hash::make($data["password"]);

        $user = User::query()->create(array_merge($data, [
            "level" => UserLevel::PENYEWA,
        ]));

        Auth::guard()->login($user);

        return redirect(RouteServiceProvider::defaultRoute($user));
    }
}
