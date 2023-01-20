<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;

    protected $table ='reportes';

    protected $primaryKey ='id_reporte';

    public $incrementing=false;

    protected $fillable = [
        'id_reporte',
        'id_area',
        'id_staff',
        'id_usuario',
        'tipo_equipo',
        'des_proble',
        'fecha_repor',
        'fecha_inicio',
        'id_staff_ati',
        'des_tra',
        'serv_con',
        'fecha_ter',
        'sol_tec',
        'marca',
        'modelo',
        'no_inve',
        'no_serie',
        'des_sol'
    ];

    public $timestamps=false;
}
