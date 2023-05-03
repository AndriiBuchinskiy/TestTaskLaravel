<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Requests\StoreRoleRequest;
use App\Requests\UpdateRoleRequest;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny',Role::class);
        $roles = Role::query()->get();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::query()->get();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $role = Role::create(['name' => $request->get('name'),
               'description' => $request->get('description')
        ]);
        $permissions = collect($request->input('permissions', []))
            ->map(function ($permission) {
                return ['permission_id' => $permission];
            });
        $role->permissions()->sync($permissions);
        session(['message' => 'Role created successfully']);

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::query()->get();
        $checkedPermissions = DB::table('permission_role')
            ->where('role_id', $role->id)
            ->pluck('permission_id')->toArray();

        return view('admin.roles.edit', compact(['role', 'permissions', 'checkedPermissions']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $data = $request->except('_token');

        $permissions = collect($request->input('permissions', []))
            ->map(function ($permission) {
                return ['permission_id' => $permission];
            });
        $role->permissions()->sync($permissions);

        $role->update($data);
        session(['message' => 'Role updated successfully']);
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if ($role->users()->exists()) {
            return back()->with('error','Роль не може бути видалена бо є користувачі з цією роллю.');
        }
        $role->permissions()->detach();
        $role->delete();
        session(['message' => 'Role deleted successfully']);
        return redirect()->route('roles.index')->with('success', 'Роль успішно видалена.');
    }
}