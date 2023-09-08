<?php

namespace App\Services\Api\Auth;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoginService
{
    /**
     * Login Proccess
     * @param \App\Http\Dto\Api\Auth\LoginDto $dto
     */
    public function __invoke($dto): JsonResponse
    {
        try {
            $user = User::where('username', $dto->getUserName())->firstOrFail();

            if (Hash::check($dto->getPassword(), $user->password))
            {
                auth()->login($user);
                auth()->user()->tokens()->delete();

                return response()->json([
                    'status' => true,
                    'message' => 'Authenticated',
                    'token' => auth()->user()->createToken("API TOKEN", ['*'], now()->addMinutes(config('sanctum.expiration')))->plainTextToken,
                ], 200);
            }
            else
            {
                return response()->json([
                    'message' => 'Password mismatch'
                ], 401);
            }
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th->getMessage(),
            ], 500);
        }
    }
}
