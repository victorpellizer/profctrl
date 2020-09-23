<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoEvento extends Model
{
   protected $table = 'tipo_evento';
   protected $primaryKey = 'idTipoEvento';
   public $timestamps = false;
   protected $fillable = [
        'tipoEvento'
   ];
   protected $hidden = [
       //
   ];
}
