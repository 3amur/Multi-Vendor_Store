<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    // define table if table not standard
    protected $table='stores'; 
    // define connection if connection not standard
    protected $connection = 'mysql';
    // define (pK) if id not standard
    protected $primaryKey = 'id';
    // define (keyType) if type not standard
    protected $keyType = 'int';
    // define autoincrement if incrementing not standard
    public $incrementing = true;
}
