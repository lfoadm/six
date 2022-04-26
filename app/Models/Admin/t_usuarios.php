<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_usuarios extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'usuario',
        'senha',
        'nick',
        'funcao',
        'celular',
        'email',
        'ativo',
    ];
}
