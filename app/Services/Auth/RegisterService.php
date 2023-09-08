<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Http\RedirectResponse;

class RegisterService
{
    /**
     * Login Process
     * @param \App\Http\Dto\Auth\RegisterDto $dto
     * @param \App\Http\Requests\Auth\RegisterFormRequest $request
     */
    public function __invoke($dto, $request): RedirectResponse
    {
        $user = User::create([
            'fullname' => $dto->getUserName(),
            'username' => $dto->getUserName(),
            'password' => $dto->getPassword(),
        ]);

        $user->assignRole('user');

        return redirect()->route('login');
    }
}
