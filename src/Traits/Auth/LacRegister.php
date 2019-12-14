<?php

namespace Kdion4891\Lac\Traits\Auth;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

trait LacRegister
{
    use RegistersUsers;

    public function showRegistrationForm()
    {
        return view('lac::auth.register');
    }

    protected function registered(Request $request, $user)
    {
        return response()->json([
            'redirect' => redirect($this->redirectPath())->getTargetUrl(),
        ]);
    }
}
