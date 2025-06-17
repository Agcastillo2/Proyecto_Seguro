<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:crear usuarios')->only(['create', 'store']);
        $this->middleware('permission:ver usuarios')->only(['index']);
    }

    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|exists:roles,name',
        ]);

        // Validar que solo admin puede asignar el rol admin
        if ($request->role === 'admin' && !auth()->user()->hasRole('admin')) {
            return redirect()->back()->withErrors(['role' => 'No tienes permiso para asignar el rol admin.'])->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente');
    }


    public function edit(User $usuario)
    {
        $roles = Role::all();
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $usuario->id,
            'role' => 'required|exists:roles,name',
        ]);

        // Validar que solo admin puede asignar el rol admin
        if ($request->role === 'admin' && !auth()->user()->hasRole('admin')) {
            return redirect()->back()->withErrors(['role' => 'No tienes permiso para asignar el rol admin.'])->withInput();
        }

        $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $usuario->syncRoles($request->role);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
