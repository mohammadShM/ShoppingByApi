<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Admin\RoleCreateRequest;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends ApiController
{

    public function index(): void
    {

    }

    public function store(RoleCreateRequest $request): JsonResponse
    {
        if (Gate::denies('create-role')) {
            return $this->errorResponse(403, 'not permission user by gates');
        }
        /** @var Role $role */
        $role = Role::query()->create([
            'title' => $request->get('title'),
        ]);
        $role->permissions()->attach($request->get('permissions'));
        return $this->successResponse(200, $role->title, 'Role created successfully');
    }

    public function show(Role $role): void
    {

    }

    public function update(Request $request, Role $role): JsonResponse
    {
        $role->update([
            'title' => $request->get('title'),
        ]);
        $role->permissions()->sync($request->get('permissions'));
        return $this->successResponse(200, $role->title, 'Role updated successfully');
    }

    public function destroy(Role $role): JsonResponse
    {
        $role->permissions()->detach();
        $role->delete();
        return $this->successResponse(201, $role->title, 'Role deleted successfully');
    }

}
