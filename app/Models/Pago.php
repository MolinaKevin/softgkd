<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getFechaAttribute()
    {
        return $this->created_at->format('d/m/Y');
    }
    public function getMesAttribute()
    {
        $mesesN=array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
            "Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        return $mesesN[(int)$this->created_at->format('m')];
    }
    public function getDiaAttribute()
    {
        return $this->created_at->format('d');
    }
    public function getAnioAttribute()
    {
        return $this->created_at->format('Y');
    }
    public function getAsociadoAttribute()
    {
        return $this->pagable->name;
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function pagable()
    {
        return $this->morphTo();
    }
}
