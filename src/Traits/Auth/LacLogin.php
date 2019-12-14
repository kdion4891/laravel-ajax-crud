<?php

namespace Kdion4891\Lac\Traits\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

trait LacLogin
{
    use AuthenticatesUsers;

    public function showLoginForm()
    {
        return view('lac::auth.login');
    }

    protected function authenticated(Request $request, $user)
    {
        return response()->json([
            'redirect' => redirect()->intended($this->redirectPath())->getTargetUrl(),
        ]);
    }
}
