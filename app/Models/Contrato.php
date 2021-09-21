<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    public function getInversion()
    {
        return $this->belongsTo('App\Models\Inversion', 'inversion_id', 'id');
    }

}
