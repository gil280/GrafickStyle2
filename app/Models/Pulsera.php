<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Pulsera extends Model
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    protected $fililable =[
        'id',
        'Diseño',
        'Imagenes',
        'Cantidad',
        'Fecha de entrega',
        'Precio',
    ];
}
