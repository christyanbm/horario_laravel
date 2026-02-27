<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Dashboard del admin
    public function index()
    {
        return view('admin.index');
    }

    // Mostrar formulario para crear usuario
    public function create()
    {
        return view('admin.create');
    }

    // Guardar usuario nuevo
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,jefe,alumno,maestro,coordinador',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('admin.usuarios')->with('success', 'Usuario creado correctamente.');
    }

    // Lista general de usuarios
    public function listUsers()
    {
        $users = User::with('roles')->get();
        return view('admin.list_users', compact('users'));
    }

    // Listar alumnos
    public function listAlumnos()
    {
        $alumnos = User::role('alumno')->get();
        return view('admin.list_alumnos', compact('alumnos'));
    }

    // Listar maestros
    public function listMaestros()
    {
        $maestros = User::role('maestro')->get();
        return view('admin.list_maestros', compact('maestros'));
    }

    // Listar jefes
    public function listJefes()
    {
        $jefes = User::role('jefe')->get();
        return view('admin.list_jefes', compact('jefes'));
    }

    // Listar coordinadores
    public function listCoordinadores()
    {
        $coordinadores = User::role('coordinador')->get();
        return view('admin.list_coordinadores', compact('coordinadores'));
    }

    // Editar usuario
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }

    // Actualizar usuario
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,jefe,alumno,maestro,coordinador',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $user->syncRoles([$request->role]);

        return redirect()->route('admin.usuarios')->with('success', 'Usuario actualizado correctamente.');
    }

    // Eliminar usuario
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.usuarios')->with('success', 'Usuario eliminado correctamente.');
    }
}
