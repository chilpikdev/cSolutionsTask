<?php

namespace App\Http\Requests\Api;

use App\Http\Dto\Api\GetProductsDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'order' => 'nullable|string',
            'by' => 'nullable|string',
            'page' => 'nullable|integer',
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
    public function getDto(): GetProductsDto
    {
        $dto = new GetProductsDto();
        $dto->setOrder($this->get('order'));
        $dto->setBy($this->get('by'));
        $dto->setPage($this->get('page'));

        return $dto;
    }
}
