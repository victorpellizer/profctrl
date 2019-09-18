<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcao extends Model
{
    protected $table = 'funcao';
    protected $primaryKey = 'idFuncao';
    public $timestamps = false;
    protected $fillable = [
        'funcao'
    ];
    public function docentes()
    {
        return $this->belongsToMany('App\Docente');
    }
}
