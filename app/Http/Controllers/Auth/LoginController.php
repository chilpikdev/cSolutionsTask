<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginFormRequest;
use App\Services\Auth\LoginService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginController extends Controller
{
    /**
     * Get View For Login Page
     */
    public function index(): View
    {
        return view('auth.login');
    }

    /**
     * Login Process
     * @param LoginFormRequest $request
     * @param LoginService $loginService
     */
    public function login(LoginFormRequest $request, LoginService $loginService): RedirectResponse
    {
        return $loginService($request->getDto(), $request);
    }
}
