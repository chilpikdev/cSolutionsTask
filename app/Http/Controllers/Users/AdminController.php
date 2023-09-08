<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Admin\StoreRequest;
use App\Http\Requests\Users\Admin\UpdateRequest;
use App\Http\Resources\Users\AdminIndexResource;
use App\Models\User;
use App\Services\DataTableService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view("users.admin.index");
    }

    /**
     * Get DataTable Resource
     * @param Request $request
     * @param DataTableService $dataTableService
     */
    public function getData(Request $request, DataTableService $dataTableService): JsonResponse
    {
        $searchParams = [
            [
                'field' => 'fullname',
                'isJson' => false,
            ],
            [
                'field' => 'username',
                'isJson' => false,
            ],
        ];

        return $dataTableService->getData($request, new User, $searchParams, AdminIndexResource::class, 'admins');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view("users.admin.create")->with(['roles' => $roles, 'permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $user = User::create($request->validated());
        $user->assignRole($request->roles);
        $user->givePermissionTo($request->permissions);

        return redirect()->route("admins.index");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $user = User::find($id);
        $roles = Role::all();
        $permissions = Permission::all();

        return view("users.admin.create")->with(["data" => $user, 'roles' => $roles, 'permissions' => $permissions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): RedirectResponse
    {
        $user = User::find($id);
        $user->syncRoles($request->roles);
        $user->syncPermissions($request->permissions);

        $data = $request->validated();

        if (!$request->password)
            $data = Arr::except($data, ['password']);

        $user->update($data);

        return redirect()->route("admins.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $user = User::find($id);

        if ((auth()->id() != $id) && auth()->user()->hasRole('admin')) {
            $user->roles()->detach();
            $user->permissions()->detach();
            $user->delete();
        }

        return response()->json(200);
    }
}
