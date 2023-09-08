<?php

namespace App\Http\Requests\Auth;

use App\Http\Dto\Auth\LoginDto;
use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
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
            'remember' => 'nullable',
        ];
    }

    /**
     * Set Dto Values
     */
    public function getDto(): LoginDto
    {
        $dto = new LoginDto();
        $dto->setUserName($this->get('username'));
        $dto->setPassword($this->get('password'));
        $dto->setRemember($this->get('remember'));

        return $dto;
    }
}
