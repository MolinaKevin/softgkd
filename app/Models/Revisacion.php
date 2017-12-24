<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Revisacion
 *
 * @package App\Models
 * @version December 16, 2017, 7:08 am UTC
 *
 * @property mediumText descripcion
 * @property boolean aprobado
 * @property dateTime finalizacion
 * @property integer medico_id
 * @property integer user_id
 */
class Revisacion extends Model
{
    use SoftDeletes;

    public $table = 'revisacions';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'descripcion',
        'aprobado',
        'finalizacion',
        'medico_id',
        'user_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'aprobado' => 'boolean',
        'finalizacion' => 'datetime',
        'medico_id' => 'integer',
        'user_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'descripcion' => 'required|min:4',
        'aprobado' => 'required',
        'finalizacion' => 'required',
        'medico_id' => 'required',
        'user_id' => 'required',
    ];
}
