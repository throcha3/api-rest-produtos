<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{

    protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'preco',
        'dt_ultima_alt'
    ];

    protected $casts = [
        'dt_ultima_alt' => 'Timestamp'
    ];

    public $timestamps = false;

}