<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
     protected $table = 'productos';

     
    public function category(){
         return $this->belongsTo(Categoria::class, 'id_categoria');
    }
  
}
