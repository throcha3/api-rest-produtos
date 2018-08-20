<?php

namespace App\Models;


class ValidationProduto
{
    const RULES_PRODUTO = [
        'nome' => 'required | max:80',
        'preco' => 'required',
        'dt_ultima_alt' => 'required | date_format: "Y-m-d"'
    ];
}