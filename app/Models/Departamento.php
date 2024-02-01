<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;
    protected $primaryKey = 'IDdepartamento';

    protected $table = 'departamento';
    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'IDdepartamento');
    }
}
