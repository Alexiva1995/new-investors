<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inversion extends Model
{
    use HasFactory;

    protected $table = 'inversiones';
    
    protected $fillable = [
       
        'invertido',
        'user_id',
        'tipo_interes',
        'fecha_consignacion',
        'referente',
        'comprobante_consignacion',
        'periodo_mes',
        'firma_cliente',
        'firma_admin'
    ];

    public function getUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
