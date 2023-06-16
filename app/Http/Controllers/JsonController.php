<?php

namespace App\Http\Controllers;

use App\Models\Deputados;

class JsonController extends Controller
{
    public function store()
    {
        $response = (new PostController)->getDeputadosList();
        Deputados::truncate();
        foreach ($response['list'] as $deputadoData) {
            $redesSociais = array_map(fn ($redeSocialObj) => $redeSocialObj['redeSocial']['nome'], $deputadoData['redesSociais']);
            $deputado = new Deputados([
                'id' => $deputadoData['id'],
                'nome' => $deputadoData['nome'],
                'partido' => $deputadoData['partido'],
                'endereco' => $deputadoData['endereco'],
                'telefone' => $deputadoData['telefone'],
                'fax' => $deputadoData['fax'],
                'email' => $deputadoData['email'],
                'sitePessoal' => $deputadoData['sitePessoal'] ?? 'empty',
                'naturalidade' => $deputadoData['naturalidadeMunicipio'],
                'uf' => $deputadoData['naturalidadeUf'],
                'nascimento' => $deputadoData['dataNascimento'],
                'redesSociais' => json_encode($redesSociais, true),
            ]);
            $deputado->save();
        }

        $deputadosData = [];
        foreach (Deputados::all() as $deputado) {
            array_push($deputadosData, $deputado->getRawOriginal());
        }
        dd($deputadosData);
    }
}
