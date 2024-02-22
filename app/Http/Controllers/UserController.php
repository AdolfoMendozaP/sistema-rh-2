<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Empleado;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login()
{
    $credentials = request()->only('username', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        if ($user->currentAccessToken()) {
            Auth::logout();
            return redirect('login')->with('error', 'Ya existe una sesión activa para este usuario.');
        }

        $user->tokens->each(function (PersonalAccessToken $token) {
            $token->delete();
        });

        $user->deleteTokensUsingDeviceId($user->currentAccessToken()->device_id);
        $token = $user->createToken('api-token');

        return $user->typeuser === 'admin' ? redirect('dashboard') : redirect('welcome')->with('token', $token->plainTextToken);
    }

    return redirect('login')->with('error', 'Credenciales inválidas');
}

public function deleteTokensUsingDeviceId($deviceId)
{
    $this->tokens()->where('device_id', $deviceId)->delete();
}

public function index()
{
    $standardUsers = User::where('typeuser', 'standard')->paginate(10);
    $adminUsers = User::where('typeuser', 'admin')->paginate(10);
    $standardUsersCount = $standardUsers->total();

    return view('users.index', compact('standardUsers', 'adminUsers', 'standardUsersCount'));
}

    public function create()
    {
        $employees = Empleado::all();
        return view('users.create', compact('employees'));
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string',
        'username' => 'required|string|unique:users',
        'password' => 'required|string',
    ]);

    $data['typeuser'] = 'standard';
    $data['username_verified_at'] = now();
    $data['remember_token'] = Str::random(10);
    $data['created_at'] = now();
    $data['updated_at'] = now();

    $data['password'] = bcrypt($data['password']);

    $user = User::create($data);

    $duplicateCheck = Empleado::where('nombre', $request->input('nombre'))
        ->where('apellido', $request->input('apellido'))
        ->where('email', $request->input('email'))
        ->count();

    if ($duplicateCheck > 0) {
        return redirect()->route('empleado.index')
            ->with('warning', 'Ya existe un empleado con el mismo nombre, apellido y correo.');
    }

    return redirect()->route('users.index');
}

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string',
        'username' => 'required|string|unique:users,username,' . $user->id,
        'password' => 'nullable|min:6',
    ]);

    $user->name = $request->input('name');
    $user->username = $request->input('username');
    
    if ($request->filled('password')) {
        $user->password = bcrypt($request->input('password'));
    }

    $user->save();
    return redirect()->route('users.index');
}

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success');
    }

    public function loginPersonal(Request $request)
{
    $user = Auth::user();

    if ($request->contrasena === $user->password_personal) {
        return redirect()->route('pagina.personal');
    }

    return redirect()->back()->with('error', 'Contraseña incorrecta');
}

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}