<?php

namespace App\Http\Requests\Auth;

use App\Http\Dto\Auth\RegisterDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterFormRequest extends FormRequest
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
            'fullname' => 'required|string|max:255',
            'username' => 'required|unique:users,username|max:255',
            'password' => ['required', 'between:8,20', 'confirmed', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()],
        ];
    }

    /**
     * Set Dto Values
     */
    public function getDto(): RegisterDto
    {
        $dto = new RegisterDto();
        $dto->setFullname($this->get('fullname'));
        $dto->setUserName($this->get('username'));
        $dto->setPassword($this->get('password'));

        return $dto;
    }
}
