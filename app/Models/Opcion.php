<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opcion extends Model
{
    public $table = 'opciones';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'clave',
        'valor'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'clave' => 'string',
        'valor' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'clave' => 'required',
        'valor' => 'required'
    ];
}
