<?php

namespace Kdion4891\Lac\Traits\Auth;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

trait LacForgotPassword
{
    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        return view('lac::auth.passwords.email');
    }

    protected function sendResetLinkResponse(Request $request, $response)
    {
        return response()->json([
            'jquery' => [
                'selector' => '#auth-passwords-email-form',
                'method' => 'replaceWith',
                'content' => view('lac::auth.passwords.email-sent', ['response' => trans($response)])->render(),
            ],
        ]);
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response()->json([
            'errors' => ['email' => [trans($response)]],
        ], 422);
    }
}
