<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // // Caso as tabelas do BD não estejam no padrão esperado pelo Laravel, você precisa declarar algumas coisas no model. São elas:
    // // Nome da tabela igual ao nome da classe e em inglês, porém no plural. Ex.: products 
    // public $tableName = "products";
    // // Chave primária declarada como id
    // public $primaryKey = "products_id";
    // // Campo para armazenar timestamp
    // public $timestamps = false;

    // Fazendo a associação das tabelas para cruzar dados de products e users.
    public function users(){
        return $this->belongsTo('App\User');
    }
}
