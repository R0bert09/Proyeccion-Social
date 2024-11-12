<?php
namespace App\Http\Controllers;

use App\Mail\mailrecuperarpassword;
use App\Models\CodigosRecuperacion;
use App\Models\User;
use App\Models\Seccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function list(Request $request)
    {
        $perPage = $request->input('per_page', 10);

            $estudiantes = User::estudiantesPorSeccion()
                ->select('users.*', 'secciones.nombre_seccion as seccion')
                ->toBase();

            $tutores = User::tutoresPorSeccion()
                ->select('users.*', 'secciones.nombre_seccion as seccion')
                ->toBase();

            $coordinadores = User::coordinadoresPorSeccion()
                ->select('users.*', 'secciones.nombre_seccion as seccion')
                ->toBase();

            $administradores = User::AdministradoresPorSeccion()
                ->select('users.*', \DB::raw("'Este usuario no posee seccion' as seccion"))
                ->toBase();

            $query = User::query()->fromSub(
                $administradores
                    ->unionAll($coordinadores)
                    ->unionAll($tutores)
                    ->unionAll($estudiantes),
                'users_ordenados'
            );

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

        return redirect()->route('usuarios')->with('success', 'Usuario creado exitosamente');
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

    public function enviocorreocode(Request $request){
        try {
            $email = $request->correo;
            $user = User::where('email', $email)->first();
            $codigo = substr(md5(uniqid()), 0, 6);
            $codigorecuperacion = new CodigosRecuperacion();
            $codigorecuperacion->codigo = $codigo;
            CodigosRecuperacion::create([
                'codigo' => $codigo
            ]);
            $urlpassword = url('/resetearpassword/'.$user->id_usuario);
            Mail::to($email)->send(new mailrecuperarpassword($user, $codigo, $urlpassword));
            session()->flash('success', 'Se ha enviado un correo con el código de recuperación');
            return view('auth.recupassword');
        }catch (\Exception $e) {
            session()->flash('error', 'El correo no existe');
        }
    }
    public function resetearpassword($idUser){
        return view('auth.resetpassword', compact('idUser'));
    }
    public function updatepassword(Request $request, $idUser){
        $user = User::find($idUser);
        $codigo = CodigosRecuperacion::where('codigo', $request->codigo_verificacion)->first();
        if(!$codigo){
            session()->flash('error', 'El código de verificación es incorrecto');
            return view('auth.resetpassword', compact('idUser'));
        }
        $user->password = bcrypt($request->nueva_contrasena);
        $user->save();
        CodigosRecuperacion::where('codigo', $request->codigo_verificacion)->delete();
        return redirect('/');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('correo', 'contrasena');

        if (Auth::attempt(['email' => $credentials['correo'], 'password' => $credentials['contrasena']])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return redirect()->route('login')->withErrors([
            'error' => 'Usuario o contraseña inválidos.',
        ]);
    }
}