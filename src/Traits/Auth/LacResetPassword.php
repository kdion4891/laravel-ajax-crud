<?php

namespace Kdion4891\Lac\Traits\Auth;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

trait LacResetPassword
{
    use ResetsPasswords;

    public function showResetForm(Request $request, $token = null)
    {
        return view('lac::auth.passwords.reset', ['token' => $token, 'email' => $request->email]);
    }

    protected function sendResetResponse(Request $request, $response)
    {
        return response()->json([
            'redirect' => redirect($this->redirectPath())->getTargetUrl(),
        ]);
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json([
            'errors' => ['email' => [trans($response)]],
        ], 422);
    }
}
