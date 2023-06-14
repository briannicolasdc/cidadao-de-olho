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
     *
     */

    /*public function sort (array $tmpArray){
        $array = array();
        usort($tmpArray, fn($a, $b) => $b['valor'] <=> $a['valor']);
        $array = array_slice($tmpArray, 0, 5, true);
        dd($array);
    }*/

    public function deputados()
    {
        $response = Http::get('http://dadosabertos.almg.gov.br/ws/deputados/lista_telefonica?formato=json');
        $jsonData = json_decode($response, true);
        $total = Array();
        foreach ($jsonData['list'] as $key ) {
            $id = $key['id'];
            $value = 0;

            for($i = 1; $i <= 12; $i++) {
                $data = Http::get('https://dadosabertos.almg.gov.br/ws/prestacao_contas/verbas_indenizatorias/deputados/'. $id . '/2019/' . $i .'?formato=json');
                $dataDecoded = json_decode($data, true);

                if(!empty($dataDecoded))
                    foreach ($dataDecoded['list'] as $gasto){
                        $value += $gasto['valor'];
                    }
                continue;
            }

            $tmp = array("valor"=> $value, "nome"=> $key['nome']);
            array_push($total, $tmp);

        }
        sort($total);
        usort($total, fn($a, $b) => $b['valor'] <=> $a['valor']);
        $total = array_slice($total, 0, 5, true);
        dd($total);
    }

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
        dd($jsonResult);
    }

}?>
