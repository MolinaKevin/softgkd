<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Deuda
 * @package App\Models
 * @version October 12, 2019, 3:59 pm -03
 *
 * @property \Illuminate\Database\Eloquent\Collection asistencias
 * @property \Illuminate\Database\Eloquent\Collection especialHorario
 * @property \Illuminate\Database\Eloquent\Collection especialUser
 * @property \Illuminate\Database\Eloquent\Collection horarioPlan
 * @property \Illuminate\Database\Eloquent\Collection permissionRole
 * @property \Illuminate\Database\Eloquent\Collection permissionUser
 * @property \Illuminate\Database\Eloquent\Collection planUser
 * @property \Illuminate\Database\Eloquent\Collection revisacions
 * @property \Illuminate\Database\Eloquent\Collection roleUser
 * @property float precio
 * @property string concepto
 * @property integer deudable_id
 * @property string deudable_type
 * @property integer adeudable_id
 * @property string adeudable_type
 */
class Deuda extends Model
{
    use SoftDeletes;

    public $table = 'deudas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'precio',
        'concepto',
        'deudable_id',
        'deudable_type',
        'adeudable_id',
        'adeudable_type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'precio' => 'float',
        'concepto' => 'string',
        'deudable_id' => 'integer',
        'deudable_type' => 'string',
        'adeudable_id' => 'integer',
        'adeudable_type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
