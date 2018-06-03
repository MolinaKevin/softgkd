<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Deuda
 *
 * @package App\Models
 * @version December 16, 2017, 7:30 am UTC
 *
 * @property double precio
 * @property integer adeudable_id
 * @property string adeudable_type
 * @property integer deudable_id
 * @property string deudable_type
 */
class Deuda extends Model
{
    use SoftDeletes;

    public $table = 'deudas';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'precio',
        'concepto',
        'adeudable_id',
        'adeudable_type',
        'deudable_id',
        'deudable_type',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'precio' => 'double',
        'adeudable_id' => 'integer',
        'adeudable_type' => 'string',
        'deudable_id' => 'integer',
        'deudable_type' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'precio' => 'required',
        'concepto' => 'required',
    ];

    /**
     * Relations
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     **/
    public function deudable()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     **/
    public function adeudable()
    {
        return $this->morphTo();
    }
}
