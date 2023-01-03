<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $table = 'cotacao';



    public function searchQuotation($quotationId, $serviceId ){
       
       $data =  Quotation::select(
            "cotacao.prazo_entrega",
            "cotacao.valor",
            "servicos.nm_servico",
            "transportadoras.nm_transportadora"
        )
        ->join("servicos", "servicos.id", "=", "cotacao.id_servico")
        ->join('transportadoras', 'servicos.id_transportadora', 'transportadoras.id')
        ->where('cotacao.id', $quotationId)
        ->where('servicos.id', $serviceId)
        ->get();



        return $data;
    }
}
