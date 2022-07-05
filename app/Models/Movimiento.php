<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Movimiento
 * @package App\Models
 * @version February 7, 2019, 11:54 am -03
 *
 * @property double precio
 * @property string concepto
 */
class Movimiento extends Model
{
    use SoftDeletes;

    public $table = 'movimientos';

    protected $dates = ['deleted_at'];


    public $fillable = [
        'precio',
        'concepto'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'precio' => 'double',
        'concepto' => 'string',
        'deudable_id' => 'integer',
        'deudable_type' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'precio' => 'required|numeric',
        'concepto' => 'required'
    ];

    public function getFechaAttribute()
    {
        return $this->created_at->format('d/m/Y');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     **/
    public function adeudable()
    {
        return $this->morphTo();
    }
}
