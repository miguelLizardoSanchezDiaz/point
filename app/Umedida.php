<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Umedida extends Model
{
    protected $connection = 'medida';
    protected $table = "unidad_medida";
    public $timestamps = false;

    
}
