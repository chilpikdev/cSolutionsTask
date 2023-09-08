<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterFormRequest;
use App\Services\Auth\RegisterService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RegisterController extends Controller
{
    /**
     * Get View For Register Page
     */
    public function index(): View
    {
        return view('auth.register');
    }

    /**
     * Login Process
     * @param RegisterFormRequest $request
     * @param RegisterService $loginService
     */
    public function register(RegisterFormRequest $request, RegisterService $registerService): RedirectResponse
    {
        return $registerService($request->getDto(), $request);
    }
}
