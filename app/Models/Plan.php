<?php

namespace App\Models;

use App\Traits\CanBeAdeudar;
use App\Models\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Plan
 *
 * @package App\Models
 * @version January 6, 2018, 4:54 pm UTC
 *
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
        'limite',
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
        'porDia' => 'integer',
    ];

    protected $appends = ['pagado','descriptivo'];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cantidad' => 'required',
        'name' => 'required',
        'precio' => 'required',
    ];

    /**
     * Mutators
     **/
    public function setDateAttribute($date)
    {
        $this->attributes['date'] = $date ? 1 : 0;
    }

    public function setLimiteAttribute($limite)
    {
        $this->attributes['limite'] = $limite ? 1 : 0;
    }

    public function setClasesAttribute($clases)
    {
        $this->pivot->clases = $clases;
    }

    public function setVencimientoAttribute($vencimiento)
    {
        $this->pivot->vencimiento = $vencimiento;
    }

    /**
     * Accessors
     **/
    public function getDateAttribute($value)
    {
        return ($value == 1) ? 'Días' : 'Clases';
    }

    public function getDescriptivoAttribute($value)
    {
        return $this->name . '[' . ']';
    }

    public function getLimiteAttribute($value)
    {
        return ($value == 1) ? 'Activado' : 'Desactivado';
    }

    public function getPagadoAttribute($value)
    {
        if (! $this->pivot) {
            return null;
        }

        return ($this->pivot->pagado == 0) ? false : true;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('id','vencimiento', 'clases', 'pagado')->using('App\Models\PlanUser');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function horarios()
    {
        return $this->belongsToMany(Horario::class);
    }
}
