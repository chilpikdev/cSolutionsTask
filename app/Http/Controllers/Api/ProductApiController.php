<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductApiRequest;
use App\Services\Api\ProductApiService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductApiController extends Controller
{
    /**
     * Get Products
     * @param ProductApiRequest $request
     * @param ProductApiService $productApiService
     */
    public function __invoke(ProductApiRequest $request, ProductApiService $productApiService): JsonResponse
    {
        return $productApiService($request->getDto());
    }
}
