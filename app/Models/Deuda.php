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
 * @property integer familia_id
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
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'precio' => 'required',
        'concepto' => 'required',
        'familia_id' => 'required',
    ];

    /**
     * Relations
     */
    public function deudable()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function adeudable()
    {
        return $this->morphTo();
    }
}
