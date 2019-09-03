<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('user.role', compact('roles', 'permissions'));
    }

    public function create() {

    }

    public function store(Request $request) {

    }

    public function edit() {

    }

    public function update(Request $request, $id) {
        $role = Role::findOrFail($id);
        $role->syncPermissions($request->permissions);

        flash('Peran berhasil di edit')->success();

        return redirect(route('role'));
    }

    public function destroy($id) {

    }

}
