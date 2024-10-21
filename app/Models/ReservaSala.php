<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservaSala extends Model
{
    use HasFactory;

    // Desativa a gestão automática dos timestamps
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome_sala',
        'dt_hr_inicio',
        'dt_hr_termino',
        'nome_responsavel',
        'status',
    ];
}
