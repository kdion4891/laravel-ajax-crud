<?php

namespace Kdion4891\Lac\Traits\Auth;

use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\Request;

trait LacConfirmPassword
{
    use ConfirmsPasswords;

    public function showConfirmForm()
    {
        return view('lac::auth.passwords.confirm');
    }

    public function confirm(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        $this->resetPasswordConfirmationTimeout($request);

        return response()->json([
            'redirect' => redirect()->intended($this->redirectPath())->getTargetUrl()
        ]);
    }
}
