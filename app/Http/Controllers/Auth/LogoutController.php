<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LogoutController extends Controller
{
    /**
     * User logout
     */
    public function __invoke(): RedirectResponse
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
