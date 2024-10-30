<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanAhorro extends Model
{
    use HasFactory;

    protected $table = 'planes_ahorro';

    protected $fillable = [
        'pdaMarca', 'pdaDescrip', 'pdaCuotaBase', 'pdaVerCodigo', 'pdaModCodigo', 'pdaModelo',
        'pdaVersion', 'pdaNombre', 'pdaTipoPlan', 'pdaLegales', 'pdaVigencia',
        'pdaCuotas', 'pdaUrl'
    ];
}
