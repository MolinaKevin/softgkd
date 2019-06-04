<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Plan
 * @package App\Models
 * @version April 20, 2019, 5:50 pm -03
 *
 * @property \Illuminate\Database\Eloquent\Collection asistencias
 * @property \Illuminate\Database\Eloquent\Collection especialHorario
 * @property \Illuminate\Database\Eloquent\Collection especialUser
 * @property \Illuminate\Database\Eloquent\Collection horarioPlan
 * @property \Illuminate\Database\Eloquent\Collection permissionRole
 * @property \Illuminate\Database\Eloquent\Collection permissionUser
 * @property \Illuminate\Database\Eloquent\Collection PlanUser
 * @property \Illuminate\Database\Eloquent\Collection revisacions
 * @property \Illuminate\Database\Eloquent\Collection roleUser
 * @property string name
 * @property float precio
 * @property integer cantidad
 * @property boolean date
 * @property integer porDia
 * @property boolean limite
 */
class Plan extends Model
{
    use SoftDeletes;

    public $table = 'plans';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'precio',
        'cantidad',
        'date',
        'porDia',
        'limite'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'precio' => 'float',
        'cantidad' => 'integer',
        'date' => 'integer',
        'porDia' => 'integer',
        'limite' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function horarios()
    {
        return $this->belongsToMany(\App\Models\Horario::class, 'horario_plan');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function planUsers()
    {
        return $this->hasMany(\App\Models\PlanUser::class);
    }
}
