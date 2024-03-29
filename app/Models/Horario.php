<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Horario
 * @package App\Models
 * @version February 11, 2018, 10:59 pm UTC
 *
 * @property enum dia
 * @property integer hora
 */
class Horario extends Model
{
    use SoftDeletes;

    public $table = 'horarios';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'dia',
        'hora'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'dia' => 'string',
        'hora' => 'time',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'dia' => 'required',
        'hora' => 'required'
    ];

    /**
     * Accessors
     **/

    public function getNameAttribute()
    {
        return (string) $this->dia.', '.$this->hora . 'Hs.';
    }

    public function getHoraAttribute($value)
    {
        return (string) Carbon::parse($value)->format('H:i');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }
}
