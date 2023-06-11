<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function deputados()
    {
        $response = Http::get('http://dadosabertos.almg.gov.br/ws/deputados/lista_telefonica?formato=json');
        $jsonData = $response->json();
        dd($jsonData);
        return $jsonData;
    }



}?>
