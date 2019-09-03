<?php

namespace App\Http\Controllers;

use App\Cabang;
use App\Pasar;
use App\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:user-read');
    }

    public function index() {
        $users = User::all();
        $roles = Role::all();
        $pasar = Pasar::all()->pluck('nama', 'id');
        $cabang = Cabang::all()->pluck('nama', 'id');

        return view('user.index', compact('users', 'roles', 'pasar', 'cabang'));
    }

    public function create() {

    }

    public function store(Request $request) {
        if (!Auth::user()->can('user-edit')) {
            return redirect(route('user'));
        }

        $user = User::create($request->only('id_pasar', 'id_cabang', 'username', 'name', 'password'));

        $role = $request['roles'];
        $mrole = Role::findOrFail($role);
        $user->assignRole($mrole);

        flash('User berhasil ditambahkan.')->success();

        return redirect(route('user'));
    }

    public function edit() {

    }

    public function update(Request $request, $id) {
        if (!Auth::user()->can('user-edit')) {
            return redirect(route('user'));
        }

        $user = User::findOrFail($id);
        $user->fill($request->only('id_pasar', 'id_cabang', 'username', 'name', 'password'))->save();

        $roles = $request->roles;
        $user->syncRoles($roles);

        flash('User berhasil diedit.')->success();

        return redirect(route('user'));
    }

    public function destroy($id) {
        if (!Auth::user()->can('user-edit')) {
            return redirect(route('user'));
        }

        $user = User::findOrFail($id);
        $user->delete();

        flash('User berhasil dihapus.')->success();

        return redirect(route('user'));
    }

    public function changePassword() {
        return view('change_password');
    }

    public function changePasswordAct(Request $request) {
        if (!(Hash::check($request->current_password, Auth::user()->password))) {
            return redirect()->back()->with('error', 'Password saat ini yang anda masukkan salah.');
        }

        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        // dd(bcrypt($request->new_password));

        Auth::user()->update(['password' => $request->new_password]);
        // $user->save();

        return redirect()->back()->with('success', 'Password berhasil diganti!');
    }
}