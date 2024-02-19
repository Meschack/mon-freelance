<?php

namespace App\Http\Controllers;

use App\Notifications\SendTwoFactorCode;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TwoFactorController extends Controller
{
    public function index()
    {
        return view("auth.twofactor");
    }

    public function store(Request $request)
    {
        $request->validate([
            'two_factor_code' => ['integer', 'required'],
        ]);

        /**
         * @var \App\Models\User
         */

        $user = auth()->user();
        if ($request->input('two_factor_code') !== $user->two_factor_code) {
            throw ValidationException::withMessages([
                'two_factor_code' => __('The two factor code you have entered does not match'),
            ]);
        }

        $user->resetTwoFactorCode();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function resend(): RedirectResponse
    {
        /**
         * @var \App\Models\User
         */

        $user = auth()->user();
        $user->generateTwoFactorCode();
        $user->notify(new SendTwoFactorCode());

        return redirect()->back()->withStatus(__('The two factor code has been sent again'));
    }
}
