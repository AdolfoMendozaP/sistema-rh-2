<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\OrboandingController;
use App\Http\Controllers\AusenciaController;
use App\Http\Controllers\ForgotPasswordController;
use Laravel\Sanctum\PersonalAccessToken;
use App\Http\Controllers\PersonalController;
use Carbon\Carbon;


Route::delete('/ausencia/borrar/{id}', [AusenciaController::class, 'borrar'])->name('ausencia.borrar');
Route::post('/ausencia/confirmar/{id}', [AusenciaController::class, 'confirmar'])->name('ausencia.confirmar');
Route::post('/ausencia/denegar/{id}', [AusenciaController::class, 'denegar'])->name('ausencia.denegar');
Route::post('/solicitar-ausencia', [AusenciaController::class, 'solicitarAusencia'])->name('ausencia.solicitar');
Route::resource('personales', PersonalController::class);
Route::get('/ausencia', [AusenciaController::class, 'index'])->name('ausencia.index');
Route::get('/get-attendance-reports', [AsistenciaController::class, 'getAttendanceReports']);
Route::get('/get-new-records', [EmpleadoController::class, 'getNewRecords']);
Route::get('/empleado/foto/{id}', [EmpleadoController::class, 'showPhoto'])->name('empleado.photo');
Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::get('/get-attendance-reports', [EmpleadoController::class, 'getAttendanceReports']);
//Route::get('/get-notifications', [EmpleadoController::class, 'getNotifications']);
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/get-password/{userId}', [UserController::class, 'getPassword']);
Route::get('/show-photo/{id}', 'EmpleadoController@showPhoto')->name('show.photo');
Route::put('/empleado/foto/{id}', 'EmpleadoController@updatePhoto')->name('empleado.update_photo');
Route::delete('/empleado/foto/{id}', 'EmpleadoController@deletePhoto')->name('empleado.delete_photo');

Route::resource('users', UserController::class);
Route::get('/orboarding', [OrboandingController::class, 'index']);
Route::get('/asistencia', [AsistenciaController::class, 'index'])->name('asistencia.index');
Route::post('/asistencia/registrar', [AsistenciaController::class, 'registrar'])->name('asistencia.registrar');
Route::post('/asistencia/depurar', [AsistenciaController::class, 'depurarRegistros'])->name('asistencia.depurar');

Route::resource('/empleado', EmpleadoController::class)->names([
    'index' => 'empleado.index',
    'create' => 'empleado.create',
    'store' => 'empleado.store',
    'edit' => 'empleado.edit',
    'update' => 'empleado.update',
    'destroy' => 'empleado.destroy',
]);
Route::view('/', 'login')->name('login')->middleware('guest');
Route::view('login', 'login')->name('login')->middleware('guest');
Route::resource('users', UserController::class);
Route::view('dashboard', 'dashboard')->middleware('auth');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::get('/export/excel', [AsistenciaController::class, 'exportExcel'])->name('export.excel');
Route::view('welcome', 'welcome')->middleware('auth');

Route::post('logout', [UserController::class, 'logout'])->name('logout');

Route::post('login', function () {
    $credentials = request()->only('username', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        $user->tokens->each(function (PersonalAccessToken $token) {
            $token->delete();
        });

        return $user->typeuser === 'admin' ? redirect('dashboard') : redirect('welcome');
    }

    return redirect('login')->with('error', 'Credenciales inválidas');
})->middleware('guest');

Route::middleware(['auth'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('welcome', 'welcome')->name('welcome');
});
