<?php

namespace App\Services\Auth;
use Illuminate\Http\RedirectResponse;

class LoginService
{
    /**
     * Login Process
     * @param \App\Http\Dto\Auth\LoginDto $dto
     * @param \App\Http\Requests\Auth\LoginFormRequest $request
     */
    public function __invoke($dto, $request): RedirectResponse
    {
        if (auth()->attempt(['username' => $dto->getUserName(), 'password' => $dto->getPassword()], $dto->isRemember()) || auth()->viaRemember()) {
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }
        else
        {
            return back()->withErrors([
                "user_not_found" => "The credentials you entered did not match our records.",
            ]);
        }
    }
}
