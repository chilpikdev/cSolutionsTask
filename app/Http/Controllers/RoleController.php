<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleFormRequest;
use App\Http\Resources\RoleIndexResource;
use App\Services\DataTableService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view("role.index");
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

        return $dataTableService->getData($request, new Role, $searchParams, RoleIndexResource::class);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $permissions = Permission::all();

        return view("role.create")->with(['permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleFormRequest $request): RedirectResponse
    {
        $role = Role::create(['guard_name' => 'web', 'name' => $request->name]);

        $role->givePermissionTo($request->permissions);

        return redirect()->route("roles.index");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $data = Role::find($id);
        $permissions = Permission::all();

        return view("role.create")->with(["data" => $data, 'permissions' => $permissions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleFormRequest $request, string $id): RedirectResponse
    {
        $role = Role::find($id);

        $role->syncPermissions($request->permissions);

        $role->update([
            'name' => $request->name,
        ]);

        return redirect()->route("roles.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $role = Role::find($id);
        $role->permissions()->detach();
        $role->delete();

        return response()->json(200);
    }
}
