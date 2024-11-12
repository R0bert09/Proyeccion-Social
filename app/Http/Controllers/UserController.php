<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Seccion;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list(Request $request)
    {
        $perPage = $request->input('per_page', 10);
    
        // Obtener consultas de cada rol con scopes
        $estudiantes = User::estudiantesPorSeccion()->select('users.*')->toBase();
        $tutores = User::tutoresPorSeccion()->select('users.*')->toBase();
        $coordinadores = User::coordinadoresPorSeccion()->select('users.*')->toBase();
        $administradores = User::AdministradoresPorSeccion()->select('users.*')->toBase();
    
        // Combinar los resultados en el orden deseado
        $query = User::query()->fromSub(
            $administradores
                ->unionAll($coordinadores)
                ->unionAll($tutores)
                ->unionAll($estudiantes),

            'users_ordenados'
        );
    
        // Aplicar paginación
        $users = $query->paginate($perPage);
        return view('usuarios.listaUsuario', compact('users'));
    }
    
    //mostrar usuario especifico
    public function showPerfil($id)
    {
        // Obtener el usuario por id
        $usuario = User::findOrFail($id);
    
        // Pasar el usuario a la vista
        return view('perfil.perfilUsuario', compact('usuario'));
    }
    public function allSeccion()
    {
        $secciones=Seccion::all();
        return view("usuarios.crearUsuario",compact("secciones"));
    }
    public function store(Request $request)
    {
        try {
            // Validación de los datos
            $request->validate([
                'nombre' => 'required|string|max:255',
                'correo' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'rol' => 'required|string|exists:roles,name',
            ], [
                'nombre.required' => 'El nombre es obligatorio.',
                'correo.required' => 'El correo es obligatorio.',
                'correo.email' => 'El correo debe ser válido.',
                'correo.unique' => 'Este correo ya está registrado.',
                'password.required' => 'La contraseña es obligatoria.',
                'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
                'rol.required' => 'El rol es obligatorio.',
                'rol.exists' => 'El rol seleccionado no existe.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }

        $user = User::create([
            'name' => $request->nombre,
            'email' => $request->correo,
            'password' => bcrypt($request->password),
        ]);

        // Asignar el rol al usuario
        $user->assignRole($request->rol);

        return response()->json(['message' => 'Usuario creado exitosamente']);
    }

    public function deleteSelected(Request $request)
    {
        // Validar que se haya seleccionado al menos un usuario
        $request->validate([
            'users' => 'required|array',
            'users.*' => 'exists:users,id_usuario'
        ]);

        // Eliminar los usuarios seleccionados
        User::whereIn('id_usuario', $request->input('users'))->delete();

        return redirect()->route('usuarios')->with('success', 'Usuarios eliminados exitosamente.');
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $secciones=Seccion::all();
        return view('usuarios.editarUsuario', compact('usuario', 'secciones'));
    }
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'correo' => 'required|email|unique:users,email,' . $id . ',id_usuario', // Especifica id_usuario
                'password' => 'nullable|string|min:8',
                'rol' => 'required|string|exists:roles,name',
            ], [
                'nombre.required' => 'El nombre es obligatorio.',
                'correo.required' => 'El correo es obligatorio.',
                'correo.email' => 'El correo debe ser válido.',
                'correo.unique' => 'Este correo ya está registrado.',
                'rol.required' => 'El rol es obligatorio.',
                'rol.exists' => 'El rol seleccionado no existe.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    
        $usuario = User::findOrFail($id);
        $usuario->name = $request->nombre;
        $usuario->email = $request->correo;
    
        $usuario->save();
    
        // Actualizar el rol del usuario
        $usuario->syncRoles($request->rol);
    
        return redirect()->route('usuarios')->with('success', 'Usuario actualizado exitosamente');
    }
}