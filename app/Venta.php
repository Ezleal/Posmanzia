<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';


    public function cliente(){
         return $this->belongsTo(Cliente::class,'id_cliente');
    }
    public function vendedor(){
         return $this->belongsTo(User::class, 'id_vendedor');
    }

}
