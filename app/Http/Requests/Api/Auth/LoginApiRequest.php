<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Dto\Api\Auth\LoginDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoginApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|exists:users,username',
            'password' => 'required|min:8',
        ];
    }

    /**
     * Validation Errors
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator): JsonResponse
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

    /**
     * Set Dto Values
     */
    public function getDto(): LoginDto
    {
        $dto = new LoginDto();
        $dto->setUserName($this->get('username'));
        $dto->setPassword($this->get('password'));

        return $dto;
    }
}