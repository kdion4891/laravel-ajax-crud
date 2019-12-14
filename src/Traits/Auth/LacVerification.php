<?php

namespace Kdion4891\Lac\Traits\Auth;

use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

trait LacVerification
{
    use VerifiesEmails;

    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('lac::auth.verify');
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'redirect' => redirect($this->redirectPath())->getTargetUrl(),
            ]);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json([
            'jquery' => [
                'selector' => '#auth-verify-form',
                'method' => 'replaceWith',
                'content' => view('lac::auth.verify-resent')->render(),
            ],
        ]);
    }
}
