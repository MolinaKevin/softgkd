<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Asistencia
 * @package App\Models
 * @version May 19, 2018, 5:28 pm UTC
 *
 * @property date horario
 * @property integer user_id
 */
class Asistencia extends Model
{
    use SoftDeletes;

    public $table = 'asistencias';

    protected $dates = ['deleted_at'];

    protected $appends = ['fecha', 'hora'];

    public $fillable = [
        'horario',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'horario' => 'date',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'horario' => 'date',
        'user_id' => 'required'
    ];

    /**
     * Accessor
     */

    public function getFechaAttribute()
    {
        return $this->horario->format('Y-m-d');
    }

    public function getHoraAttribute()
    {
        return $this->horario->format('H:m');
    }

    /**
     * Mutator
     */

    public function setHorarioAttribute($value)
    {
        $this->attributes['horario'] = Carbon::parse($value);
    }
}
