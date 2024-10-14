<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sudadera extends Model
{
    use HasFactory;

    protected $fililable =[
        'id',
        'Diseño',
        'Imagenes',
        'Cantidad',
        'Fecha de entrega',
        'Precio',
    ];
}
