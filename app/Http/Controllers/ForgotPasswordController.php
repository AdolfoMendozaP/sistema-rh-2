<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Auth\Notifications\ResetPassword;

class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Verifica si el correo pertenece a un empleado registrado
        $employee = Empleado::where('email', $request->email)->first();

        if (!$employee) {
            return back()->withErrors(['email' => 'El correo electrónico no está registrado en la base de datos.']);
        }

        // Personaliza la lógica de envío del enlace de restablecimiento
        $token = $this->broker()->createToken($employee);

        // Utiliza la notificación predeterminada de Laravel para enviar el enlace
        $employee->notify(new ResetPassword($token));

        return back()->with('status', 'Se ha enviado un enlace de restablecimiento a tu correo electrónico.');
    }
}
