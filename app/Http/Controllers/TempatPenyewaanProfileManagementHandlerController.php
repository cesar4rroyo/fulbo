<?php

namespace App\Http\Controllers;

use App\Enums\MessageState;
use App\User;
use Illuminate\Http\Request;
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
        $data = $request->validate([
            "name" => ["required", "string"],
            "email" => ["required", "string", Rule::unique(User::class)->ignoreModel(auth()->user())],
            "tanggal_lahir" => ["required", "dateformat:Y-m-d"],
            "password" => ["nullable", "string", "confirmed"],
        ]);

        if (isset($data["password"])) {
            $data["password"] = Hash::make($data["password"]);
        }
        else {
            unset($data["password"]);
        }

        auth()->user()->update($data);

        return redirect()->back()
            ->with("messages", [
                [
                    "content" => __("messages.update.success"),
                    "state" => MessageState::STATE_SUCCESS
                ]
            ]);
    }
}
