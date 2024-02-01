<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $fillable = ['fecha', 'entrada', 'salida', 'semana', 'dia', 'validar'];
    protected $primaryKey = 'IDasistencia';

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'IDasistencia', 'IDempleado');
    }
    
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'IDasistencia', 'IDempleado');
    }
}
