<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /** Dashboard del admin */
    public function index()
    {
        return view('admin.index');
    }

    /** Formulario para crear usuario */
    public function create()
    {
        $roles = Role::all(); // Cargar roles reales de la BD
        return view('admin.create', compact('roles'));
    }

    /** Guardar nuevo usuario */
    public function store(Request $request)
{
    $rules = [
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'role'     => 'required|exists:roles,name',
    ];

    // Si es alumno, agregamos validación de matrícula
    if ($request->role === 'Alumno') {
        $rules['matricula'] = 'required|string|unique:users,matricula';
    }

    $request->validate($rules);

    $userData = [
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
    ];

    // Si es alumno, agregamos matrícula y créditos
    if ($request->role === 'Alumno') {
        $userData['matricula'] = $request->matricula;
        $userData['creditos'] = 30;
    }

    $user = User::create($userData);
    $user->assignRole($request->role);

    return redirect()
        ->route('admin.usuarios')
        ->with('success', 'Usuario creado correctamente.');
}


    /** Lista general de usuarios */
    public function listUsers()
    {
        $users = User::with('roles')->get();
        return view('admin.list_users', compact('users'));
    }

    /** Listar alumnos */
    public function listAlumnos()
    {
        $alumnos = User::role('alumno')->get();
        return view('admin.list_alumnos', compact('alumnos'));
    }

    /** Listar maestros */
    public function listMaestros()
    {
        $maestros = User::role('maestro')->get();
        return view('admin.list_maestros', compact('maestros'));
    }

    /** Listar jefes */
    public function listJefes()
    {
        $jefes = User::role('jefe')->get();
        return view('admin.list_jefes', compact('jefes'));
    }

    /** Listar coordinadores */
    public function listCoordinadores()
    {
        $coordinadores = User::role('coordinador')->get();
        return view('admin.list_coordinadores', compact('coordinadores'));
    }

    /** Formulario editar usuario */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all(); // Cargar roles reales
        return view('admin.edit_user', compact('user', 'roles'));
    }

    /** Actualizar usuario */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required|exists:roles,name', // Validación real
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        $user->syncRoles([$request->role]); // Reasigna correctamente

        return redirect()
            ->route('admin.usuarios')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    /** Eliminar usuario */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()
            ->route('admin.usuarios')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}
