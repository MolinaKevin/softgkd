<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Especial
 * @package App\Models
 * @version June 1, 2018, 4:19 pm -03
 *
 * @property string name
 * @property double precio
 * @property integer cantidad
 * @property tinyInteger date
 * @property integer porDia
 * @property boolean limite
 */
class Especial extends Model
{
    use SoftDeletes;

    public $table = 'especials';

    protected $dates = ['deleted_at'];

    protected $appends = ['pagado','descriptivo','parseado'];

    public $fillable = [
        'name',
        'precio',
        'cantidad',
        'date',
        'porDia',
        'limite',
        'renovable',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'cantidad' => 'integer',
        'precio' => 'double',
        'porDia' => 'integer',
        'limite' => 'boolean',
        'renovable' => 'boolean',
        'date' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'precio' => 'required|numeric',
        'cantidad' => 'required|numeric',
    ];

    /**
     * Methods
     */

    public function user()
    {
        $this->users()->first();
    }

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

    public function getFirstUserAttribute() {
        return $this->users()->first();
    }

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
        return $this->belongsToMany(User::class)->withPivot('id','vencimiento', 'clases', 'pagado')->using('App\Models\EspecialUser');
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
    public function dispositivo()
    {
        return $this->morphToMany(Dispositivo::class, 'ingresable');
    }
}
