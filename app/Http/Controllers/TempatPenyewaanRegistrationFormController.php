<?php

namespace App\Http\Controllers;

use App\Providers\AuthServiceProvider;
use Illuminate\Http\Request;

class TempatPenyewaanRegistrationFormController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return response()->view("tempat-penyewaan-registration");
    }
}
