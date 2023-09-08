<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginApiRequest;
use App\Services\Api\Auth\LoginService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoginController extends Controller
{
    /**
     * Login with Sanctum
     * @param LoginApiRequest $request
     * @param LoginService $loginService
     */
    public function __invoke(LoginApiRequest $request, LoginService $loginService): JsonResponse
    {
        return $loginService($request->getDto());
    }
}
