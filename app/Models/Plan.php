<?php

namespace App\Models;

use App\Traits\CanBeAdeudar;
use App\Models\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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

    protected $appends = ['pagado','descriptivo','parseado'];

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
        'date' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cantidad' => 'required',
        'name' => 'required',
        'precio' => 'required',
        'clases' => 'min:0'
    ];

    /**
     * Mutators
     **/
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
    public function getParseadoAttribute($value)
    {
        switch ($this->date) {
            case 0:
                $temp = 'Clases';
                break;
            case 1:
                $temp = 'Días';
                break;
            case 2:
                $temp = 'Semanal';
                break;
            case 3:
                $temp = 'Mensual';
                break;
            case 4:
                $temp = 'Anual';
                break;
            default:
                $temp = 'Clases';
                break;
        }
        return $temp;
    }

    public function getDescriptivoAttribute($value)
    {
        return $this->name;
    }

    public function getLineaHorariosAttribute($value)
    {
        $retorno = "";
        foreach ($this->horarios as $horario) {
            $retorno .= $horario->name . "; ";
        }
        return $retorno;
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     **/
    public function dispositivos()
    {
        return $this->morphToMany(Dispositivo::class, 'ingresable');
    }
}
