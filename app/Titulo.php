<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Titulo extends Model
{
    protected $table = 'titulo';
    protected $primaryKey = 'idTitulo';
    public $timestamps = false;
    protected $fillable = [
        'caminho',
        'tipoTitulo',
        'pontosDeFormacao'
    ];
    public function docentes()
    {
        return $this->belongsToMany('App\Docente');
    }
}
