<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFormRequest;
use App\Http\Resources\ProductIndexResource;
use App\Models\Product;
use App\Services\DataTableService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        return view("product.index");
    }

    /**
     * Get DataTable Resource
     */
    public function getData(Request $request, DataTableService $dataTableService): JsonResponse
    {
        $searchParams = [
            [
                'field' => 'name',
                'isJson' => false,
            ],
        ];

        return $dataTableService->getData($request, new Product, $searchParams, ProductIndexResource::class);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view("product.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductFormRequest $request): RedirectResponse
    {
        Product::create($request->validated());

        return redirect()->route("products.index");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $data = Product::find($id);

        return view("product.create")->with(["data" => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductFormRequest $request, string $id): RedirectResponse
    {
        $data = Product::find($id);
        $data->update($request->validated());

        return redirect()->route("products.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        Product::destroy($id);
        return response()->json(200);
    }
}
