<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    protected $table = 'nivel';
    protected $primaryKey = 'idNivel';
    public $timestamps = false;
    protected $fillable = [
        'nivel'
    ];
    public function docentes()
    {
        return $this->belongsToMany('App\Docente');
    }
}
