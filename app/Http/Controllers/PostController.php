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


    function getRedes(){

        $response = Http::get('http://dadosabertos.almg.gov.br/ws/deputados/lista_telefonica?formato=json');
        $jsonData = json_decode($response, true);
        $result = array();
        foreach ($jsonData['list'] as $key => $i) {
            foreach ($i['redesSociais'] as $itemKey => $value){
                $redeSocial = $value['redeSocial'];
                if(array_key_exists($redeSocial['nome'], $result)){
                    $result[$redeSocial['nome']]++;
                }else{
                    $result[$redeSocial['nome']] = 1;
                }


            }
        }

        arsort($result);
        $jsonResult = json_encode($result);
        echo ($jsonResult);
    }



}?>
