<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Pago
 *
 * @package App\Models
 * @version December 19, 2017, 5:28 am UTC
 *
 * @property double precio
 * @property integer familia_id
 */
class Pago extends Model
{
    use SoftDeletes;

    public $table = 'pagos';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'precio',
        'concepto',
        'familia_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'precio' => 'double',
        'concepto' => 'string',
        'familia_id' => 'integer',
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function familia()
    {
        return $this->belongsTo(Familia::class);
    }
}
