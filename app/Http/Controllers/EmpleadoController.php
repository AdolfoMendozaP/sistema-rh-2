<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Departamento;
use App\Models\Asistencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Notification;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\PersonalAccessToken;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;



class EmpleadoController extends Controller
{
    public function index(Request $request)
{
    $perPage = 10;
    $currentPage = $request->get('page', 1);
    $status = $request->get('status', 'todos');
    $nuevos = 0;

    switch ($status) {
        case 'activo':
            $empleados = Empleado::where('status', 'Activo')->paginate($perPage, ['*'], 'page', $currentPage);
            break;
        case 'retirado':
            $empleados = Empleado::where('status', 'Retirado')->paginate($perPage, ['*'], 'page', $currentPage);
            break;
        case 'nuevo':
                $empleados = Empleado::where('created_at', '>=', now()->subDays(3))->paginate($perPage, ['*'], 'page', $currentPage);
                $nuevos = Empleado::where('created_at', '>=', now()->subDays(3))->count();
                break;
        default:
            $empleados = Empleado::paginate($perPage, ['*'], 'page', $currentPage);
    }

    $totalEmpleados = Empleado::count();
    $activos = Empleado::where('status', 'Activo')->count();
    $retirados = Empleado::where('status', 'Retirado')->count();

    return view('empleado.index')
        ->with('empleados', $empleados)
        ->with('totalEmpleados', $totalEmpleados)
        ->with('activos', $activos)
        ->with('retirados', $retirados)
        ->with('currentPage', $currentPage)
        ->with('status', $status);
}

    public function create()
    {
        $departamentos = Departamento::pluck('nombreDep', 'IDdepartamento');
        $fechaHoy = now()->toDateString();
        return view('empleado.create', compact('departamentos', 'fechaHoy')); 
    
        $horas = [];
        for ($hora = 8; $hora <= 18; $hora++) {
            $horas[] = sprintf('%02d:00', $hora);
        }

        
    }

    public function store(Request $request)
{
    $request->validate([
        'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'nombre' => 'required',
        'apellido' => 'required',
        'email' => 'required|email|ends_with:@consultancysc.com',
        'alta' => 'required|date',
        'termino' => 'required|date',
        'turnoEntrada' => 'required',
        'turnoSalida' => 'required',
        'puesto' => 'required',
        'IDdepartamento' => 'required|exists:departamento,IDdepartamento',
        'IDasistencia' => 'nullable|exists:asistencias,IDasistencia',
        'id' => 'nullable|exists:users,id',
    ]);

    $duplicateCheck = Empleado::where('nombre', $request->input('nombre'))
        ->where('apellido', $request->input('apellido'))
        ->where('email', $request->input('email'))
        ->count();

    if ($duplicateCheck > 0) {
        Session::flash('alert', [
            'type' => 'warning',
            'message' => 'Ya existe un empleado con el mismo nombre, apellido y correo.'
        ]);

        return redirect()->route('empleado.index');
    }

    $data = $request->except(['IDasistencia', 'turnoEntrada', 'turnoSalida']);

    if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->store('fotos', 'public');
        $data['foto'] = $fotoPath;
    }

    $data['status'] = 'Activo';
    $request->merge(['email' => $request->input('email') . '@consultancysc.com']);
    $data['turnoEntrada'] = $request->input('turnoEntrada');
    $data['turnoSalida'] = $request->input('turnoSalida');
    $data['puesto'] = $request->input('puesto');
    $data['termino'] = $request->input('termino');

    $inicialNombre = strtoupper(substr($request->input('nombre'), 0, 1));
    $inicialApellido = strtoupper(substr($request->input('apellido'), 0, 1));
    $fechaAlta = date('dYm', strtotime($request->input('alta')));
    $data['folio'] = $inicialNombre . $inicialApellido . $fechaAlta . $request->input('IDdepartamento');

    Empleado::create($data);

    return redirect()->route('empleado.index')->with('success', 'Empleado creado exitosamente.');
}

public function edit(Empleado $empleado)
{
    $departamentos = Departamento::pluck('nombreDep', 'IDdepartamento');
    $fechaHoy = now()->toDateString();
    return view('empleado.edit', compact('empleado', 'departamentos', 'fechaHoy'));
}

public function update(Request $request, Empleado $empleado)
{
    $request->validate([
        'nombre' => 'required',
        'apellido' => 'required',
        'email' => 'required|email',
        'alta' => 'required|date',
        'termino' => 'required|date',
        'status' => 'required',
        'turnoEntrada' => 'required', 
        'turnoSalida' => 'required', 
        'puesto' => 'required',
        'IDdepartamento' => 'required|exists:departamento,IDdepartamento',
        'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->input('termino') <= now()) {
        $empleado->status = 'Retirado';
        $empleado->save();
    } else {
        $data = $request->except(['foto_original']);
        if ($request->hasFile('foto')) {
            if ($empleado->foto) {
                Storage::disk('public')->delete('fotos/' . $empleado->foto);
            }
            $fotoPath = $request->file('foto')->store('fotos', 'public');
            $data['foto'] = $fotoPath;
        } else {
            $data['foto'] = $request->input('foto_original');
        }

        $empleado->update($data);
    }

    return redirect()->route('empleado.index')->with('success', 'Empleado actualizado exitosamente.');
}
    
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return redirect()->route('empleado.index')->with('success', 'Empleado eliminado exitosamente.');
    }

    public function getNewRecords()
{
    $newRecords = Empleado::with('user')
        ->where('created_at', '>=', now()->subDays(3))
        ->limit(5)
        ->get(['IDempleado', 'nombre', 'apellido', 'folio', 'id']); 

    $newRecords = $newRecords->map(function ($record) {
        return [
            'IDempleado' => $record->IDempleado,
            'nombre' => $record->nombre,
            'apellido' => $record->apellido,
            'folio' => $record->folio,
            'usuario' => $record->user->username, 
        ];
    });

    return response()->json($newRecords);
}


public function showPhoto($id)
{
    try {
        $empleado = Empleado::findOrFail($id);
        $photoPath = asset('storage/fotos/' . $empleado->foto);
        Log::info('Photo Path: ' . $photoPath);

        if (file_exists($photoPath)) {
            return response()->file($photoPath);
        } else {
            abort(404);
        }
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al obtener la foto del empleado.'], 500);
    }
}

    public function updatePhoto(Request $request, $id)
{
    $empleado = Empleado::findOrFail($id);

    $request->validate([
        'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('foto')) {
        if ($empleado->foto) {
            Storage::disk('public')->delete('fotos/' . $empleado->foto);
        }
        $fotoPath = $request->file('foto')->store('fotos', 'public');
        $empleado->foto = $fotoPath;
        $empleado->save();

        return redirect()->back()->with('success', 'Foto actualizada exitosamente.');
    } else {
        return redirect()->back()->with('error', 'No se proporcionó una nueva foto.');
    }
}

public function deletePhoto($id)
{
    $empleado = Empleado::findOrFail($id);

    if ($empleado->foto) {
        Storage::disk('public')->delete('fotos/' . $empleado->foto);
        $empleado->foto = null;
        $empleado->save();

        return redirect()->back()->with('success', 'Foto eliminada exitosamente.');
    } else {
        return redirect()->back()->with('error', 'No hay foto para eliminar.');
    }
}

}
