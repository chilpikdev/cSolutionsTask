<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionFormRequest;
use App\Http\Resources\PermissionIndexResource;
use App\Services\DataTableService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        return view("permission.index");
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

        return $dataTableService->getData($request, new Permission, $searchParams, PermissionIndexResource::class);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $roles = Role::all();

        return view("permission.create")->with(['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionFormRequest $request): RedirectResponse
    {
        $permission = Permission::create(['guard_name' => 'web', 'name' => $request->name]);

        $permission->assignRole($request->roles);

        return redirect()->route("permissions.index");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $data = Permission::find($id);
        $roles = Role::all();

        return view("permission.create")->with(["data" => $data, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionFormRequest $request, string $id): RedirectResponse
    {
        $permission = Permission::find($id);

        $permission->syncRoles($request->roles);

        $permission->update([
            'name' => $request->name,
        ]);

        return redirect()->route("permissions.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $permission = Permission::find($id);
        $permission->roles()->detach();
        $permission->delete();

        return response()->json(200);
    }
}
