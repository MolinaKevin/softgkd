<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Conexion
 * @package App\Models
 * @version October 5, 2019, 1:32 pm -03
 *
 * @property string concepto
 */
class Conexion extends Model
{
    use SoftDeletes;

    public $table = 'conexions';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'concepto'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'concepto' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'concepto' => 'required'
    ];

    
}
