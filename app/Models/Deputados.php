<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class deputados extends Model
{
    use HasFactory;



    protected $fillable = [
        'id',
        'nome',
        'partido',
        'endereco',
        'telefone',
        'fax',
        'email',
        'sitePessoal',
        'naturalidade',
        'uf',
        'nascimento',
        'redesSociais',
    ];


}


