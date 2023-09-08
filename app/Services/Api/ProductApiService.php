<?php

namespace App\Services\Api;

use App\Http\Resources\Api\GetProductsResource;
use App\Models\Product;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductApiService
{
    /**
     * Get Products
     * @param \App\Http\Dto\Api\GetProductsDto $dto
     */
    public function __invoke($dto): JsonResponse
    {
        $products = Product::query();

        $products->orderBy($dto->getBy(), $dto->getOrder());

        $products = $products->paginate(perPage: 10, page: $dto->getPage());

        return response()->json([
            'data' => GetProductsResource::collection($products->items()),
            'paginate' => [
                'page' => $products->currentPage(),
                'laspage' => $products->lastPage(),
                'perpage' => $products->perPage(),
                'lastitem' => $products->lastItem(),
                'total' => $products->total(),
            ],
        ], 200);
    }
}
