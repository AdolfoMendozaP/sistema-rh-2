<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;

class Empleado extends Model
{
    use HasFactory;
    use CanResetPasswordTrait;

    protected $table = 'empleado';
    protected $primaryKey = 'IDempleado';
    protected $fillable = ['foto', 'nombre', 'apellido', 'email', 'folio', 'alta', 'termino', 'status', 'puesto', 'IDdepartamento', 'turnoEntrada', 'turnoSalida'];
    //protected $hidden = ['IDasistencia'];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'IDdepartamento');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id');
    }
    
    public function asistencia()
    {
        return $this->hasOne(Asistencia::class, 'IDasistencia');
    }

     public function nombreCompleto()
    {
        return $this->nombre . ' ' . $this->apellido;
    }

    
}
