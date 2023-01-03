<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\Service;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuotationController extends Controller
{
    public function index()
    {
        $data = Quotation::paginate(10);
     return json_encode($data);
    }


    public function search($cepInitial, $cepFinal, $weight, $value)
    {



        $data  = Quotation::where('cep_inicio', $cepInitial)
        ->where('cep_final', $cepFinal)
        ->where('peso_inicial', $weight)
        ->where('valor', $value)->first();

     

        if(!$data){
            $code = 404;
            $msg = 'Não foi encontrado nenhuma informação com os dados fornecidos';
            return response()->json(['code'=> $code, 'msg' => $msg]);

        }
        $quotationId = $data->id;
        $serviceID = $data->id_servico;


        $quotation = new Quotation();
        $response = $quotation->searchQuotation($quotationId, $serviceID);


        if(!$response){
            $code = 404;
            $msg = 'Serviço para estes dados encontra-se indisponível';
            return response()->json(['code'=> $code, 'msg' => $msg]);
        }

        return response()->json($response, 200);


    }
}
