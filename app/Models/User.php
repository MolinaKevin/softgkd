<?php

namespace App\Models;

use App\Models\{
    Familia, Revisacion, Plan
};
use App\Traits\CanBePagar;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

/**
 * Class User
 *
 * @package App\Models
 * @version December 19, 2017, 5:51 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection Plan
 * @property \Illuminate\Database\Eloquent\Collection Familia
 * @property \Illuminate\Database\Eloquent\Collection Revisacion
 * @property string name
 * @property string email
 * @property string password
 * @property string remember_token
 */
class User extends Authenticatable
{
    use SoftDeletes;
    use ShinobiTrait;
    use CanBePagar;

    public $table = 'users';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected $appends = ['name','cuenta','proximo_vencimiento'];

    public $fillable = [
        'first_name',
        'last_name',
        'dni',
        'sexo',
        'email',
        'password',
        'remember_token',
        'direccion',
        'telefono',
        'celular',
        'fecha_nacimiento',
        'descuento',
        'familia_id',
        'estado'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'familia_id' => 'integer',
        'first_name' => 'string',
        'last_name' => 'string',
        'dni' => 'string',
        'sexo' => 'string',
        'email' => 'string',
        'password' => 'string',
        'remember_token' => 'string',
        'direccion' => 'string',
        'telefono' => 'string',
        'celular' => 'string',
        'fecha_nacimiento' => 'date',
        'descuento' => 'float',
        'estado' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:users,email',
        'dni' => 'required|unique:users,dni',
        'sexo' => 'required',
        'fecha_nacimiento' => 'required',
        'descuento' => 'min:0|max:100',
    ];

    /**
     * Methods
     **/



    public function defaultFamilia()
    {
        $familia = new Familia([
            'name' => 'Sin Grupo',
        ]);

        return $familia;
    }

    public function isInactivo()
    {
        $retorno = (bool) $this->asistencias()->where('horario',">", Carbon::now()->subDays(9))->first();
        return !$retorno;
    }

    public function aplicarDescuento($precio)
    {
        $retorno = $precio - ($this->descuento * $precio / 100);

        return $retorno;
    }

    public function hasFamilia()
    {
        return (bool) ! ($this->familia->name == 'Sin Grupo');
    }

    public function hasDeuda()
    {
        if ($this->hasFamilia()) {
            return (bool) $this->familia->deudas()->first();
        }
		
		//if (app()->runningInConsole()) {
		//	dd($this->deudas);
		//}

        return (bool) $this->deudas()->first();
    }
    public function hasSupra()
    {
        return (bool) $this->supraestado > 0;
    }

    public function hasRevisacion()
    {
        return (bool) $this->revisacions()->first();
    }

    public function hasPlanEspecial()
    {
        return (bool) $this->especials()->first();
    }

    public function hasHuella()
    {
        return (bool) $this->huellas()->first();
    }

    public function hasTag()
    {
        return (bool) $this->tag()->first();
    }

    public function hasRevisacionVencida()
    {
        if ($this->hasRevisacion()) {
            return $this->revisacions()->first()->isVencida();
        }

        return false;
    }

    public function actualizarEstado()
    {
		
		if ($this->hasSupra()) {
			$this->estado = "Supra";
		} elseif ($this->hasDeuda()) {
			$this->estado = "Deuda";
		} elseif ($this->isInactivo()) {
			$this->estado = "Inactivo";
		} elseif ($this->hasRevisacionVencida()) {
			$this->estado =  "Revisacion";
		} elseif (!$this->hasHuella() && !$this->hasTag()) {
			$this->estado =  "Metodo de acceso";
		} elseif ($this->hasPlanEspecial()) {
			$this->estado =  "Plan Especial";
		} else {
			$this->estado =  "Correcto";
		}
		if (app()->runningInConsole()){
			dd($this->estado);	
		}

		$this->save();

	}

	public function actualizarDeudas()
	{
		$plan = $this->plans()->first();
		
		$pivot = $plan->pivot;
		
		//if ($pivot->pagado == 0 && $pivot->isVencido()) {

		$last_asistencia = $this->asistencias()->orderBy('created_at', 'desc')->first();

		if ($pivot->pagado == 0 && $pivot->adeudarConDesfasaje($last_asistencia->horario)) {
        	$pivot->adeudar();
		}
		
	}
    /**
     * Mutators
     **/
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
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
    public function getFamiliaAttribute()
    {

        if (! $this->relationLoaded('familia')) {
            $this->load('familia');
        }

        return $this->getRelation('familia') ?: $this->defaultFamilia();
    }

    public function getProximoVencimientoAttribute()
    {
        $plan = $this->plans()
            ->orderBy('plan_user.created_at', 'desc')
            ->first();

        if (isset($plan->pivot->vencimiento)) {
            return Carbon::parse($plan->pivot->vencimiento)->format('d/m/Y') ?: "Sin Plan";
        }

        return "Sin Plan";

    }

    public function getNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    //public function getEstadoAttribute()
    //{
    //    if ($this->hasDeuda()) {
    //        return "Deuda";
    //    } elseif ($this->isInactivo()) {
    //        return "Inactivo";
    //    } elseif ($this->hasRevisacionVencida()) {
    //        return "Revisacion";
    //    } elseif (! $this->hasHuella()) {
    //        return "Sin Huella";
    //    } elseif ($this->hasPlanEspecial()) {
    //        return "Plan Especial";
    //    }
//
    //    return "Correcto";
    //}

    public function getBadgeEstadoAttribute()
    {
        if ($this->hasDeuda()) {
            return "<span class=\"label label-danger\">Deuda</span>";
        } elseif ($this->isInactivo()) {
            return "<span class=\"label label-info\">Inactivo</span>";
        } elseif ($this->hasRevisacionVencida()) {
            return "<span class=\"label label-danger\">Revisacion</span>";
        } elseif (!$this->hasHuella()) {
            return "<span class=\"label label-warning\">Revisacion</span>";
        } elseif($this->hasPlanEspecial()) {
            return "<span class=\"label label-info\">Plan Especial</span>";
        }
        return "<span class=\"label label-success\">Correcto</span>";
    }


    public function getPagadoAttribute($value)
    {
        return ($this->pivot->pagado == 0) ? false : true;
    }

    public function getRevisacionAttribute($value)
    {
        return $this->revisacions()->first();
    }

    public function getCuentaAttribute($value)
    {
        $pagos = $this->pagos()->where('parcial',true)->get();
        $retorno = 0;
        foreach ($pagos as $pago) {
            $retorno += $pago->precio;
        }
        return $retorno;

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function latestPlan()
    {
        return $this->hasOne(Plan::class)->latest();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function familia()
    {
        return $this->belongsTo(Familia::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function revisacions()
    {
        return $this->hasMany(Revisacion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     **/
    public function deudas()
    {
        return $this->morphMany(Deuda::class, 'adeudable');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     **/
    public function pagos()
    {
        return $this->morphMany(Pago::class, 'pagable');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     **/
    public function pagosParciales()
    {
        return $this->morphMany(Pago::class, 'pagable')->where('parcial', true);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function huellas()
    {
        return $this->hasMany(Huella::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function tag()
    {
        return $this->hasOne(Tag::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function plans()
    {
        return $this->belongsToMany(Plan::class)->withPivot('id', 'vencimiento', 'clases', 'pagado')->using('App\Models\PlanUser');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function especials()
    {
        return $this->belongsToMany(Especial::class)->withPivot('id', 'vencimiento', 'clases', 'pagado')->using('App\Models\EspecialUser');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function caja()
    {
        return $this->hasOne(Caja::class);
    }
}
