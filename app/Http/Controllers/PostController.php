<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{

    public function getDeputadosList(){
        $response = Http::get('https://dadosabertos.almg.gov.br/ws/deputados/lista_telefonica?formato=json');
        $jsonData = json_decode($response, true);
        return $jsonData;
    }

    private function getGastosMesDeputado($deputadoId, $mes) {
        $data = Http::get('https://dadosabertos.almg.gov.br/ws/prestacao_contas/verbas_indenizatorias/deputados/'. $deputadoId . '/2019/' . $mes .'?formato=json');
        $dataDecoded = $data->json();
        return $dataDecoded;
    }

    private function getGastoTotalDeputado($deputadoId) {
        $somaDeputado = 0;
        for($mes = 1; $mes <= 12; $mes++) {
            $gastoDeputado = $this->getGastosMesDeputado($deputadoId, $mes);

            if(!empty($gastoDeputado))
                foreach ($gastoDeputado['list'] as $gasto){
                    $somaDeputado += $gasto['valor'];
                }
        }

        return $somaDeputado;
    }


    public function deputados()
    {
        $deputadosResponse = $this->getDeputadosList();
        $listTotalGastos = [];
        foreach ($deputadosResponse['list'] as $deputado) {
            $tmp = ["valor"=> $this->getGastoTotalDeputado($deputado['id']), "nome"=> $deputado['nome']];
            array_push($listTotalGastos, $tmp);
        }

        usort($listTotalGastos, fn($a, $b) => $b['valor'] <=> $a['valor']);
        $top5Deputados = array_slice($listTotalGastos, 0, 5, true);
        dd($top5Deputados);
    }

    function getRedes(){

        $jsonData = $this->getDeputadosList();
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

}
