<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    protected $connection = 'medida';
    protected $table = "modelo";
    public $timestamps = false;
}
