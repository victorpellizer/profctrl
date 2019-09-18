<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $table = 'classe';
    protected $primaryKey = 'idClasse';
    public $timestamps = false;
    protected $fillable = [
        'classe'
    ];
    public function docentes()
    {
        return $this->belongsToMany('App\Docente');
    }
}

