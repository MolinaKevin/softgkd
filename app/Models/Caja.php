<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\MetodoPago;
use App\Models\Cierre;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

/**
 * Class Caja
 * @package App\Models
 * @version July 21, 2022, 11:20 am -03
 *
 * @property string name
 * @property boolean cerrado
 */
class Caja extends Model
{
    use SoftDeletes;

    public $table = 'cajas';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'cerrado',
        'user_id',
        'efectivo',
        'noEfectivo',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'cerrado' => 'boolean'
    ];

    protected $appends = ['efectivo','noEfectivo'];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

	/**
     * Methods
     **/
    public function defaultUser()
    {
        $user = new User([
            'first_name' => 'No',
            'last_name' => 'Abierto',
        ]);

        return $user;
    }
	/**
     * Methods 
     **/

    public function pagosPorTipo($id,$fecha) {
		$pagos = $this->pagos()->where('updated_at','>=', $fecha)->whereHas('metodoPago', function($query) use ($id) { $query->where('tipo_pago_id', $id); })->get();
		return $pagos;
	}

	public function movimientosPorTipo($id,$fecha) {
		return $this->movimientos()->whereHas('metodoPago', function($query) use($id){$query->where('tipo_pago_id',$id);})->where('updated_at','>=', $fecha)->get();
	}

    public function actualizarMontos() {
        $tipoPagos = $this->tipoPagos;

        foreach($tipoPagos as $tipoPago) {
            $total = $tipoPago->pivot->monto;

			$total = $this->totalTipoPago($tipoPago->id);

			dump($total);
            $tipoPago->pivot->monto = $total;
            $tipoPago->pivot->save();
        }
		
    }

    public function actualizarMontosBack() {
        $tipoPagos = $this->tipoPagos;

        foreach($tipoPagos as $tipoPago) {
            $total = $tipoPago->pivot->monto;

            $pagosEfectivo = new Collection();
			
			$pagos = $pagosEfectivo->merge($this->pagosPorTipo($tipoPago->id, $this->cerrado_at));
			$pagos = $pagosEfectivo->merge($this->movimientosPorTipo($tipoPago->id, $this->cerrado_at));

            foreach($pagos as $pago) {
                $total += $pago->precio;
            }

			dump($pagos);
			dump($total);
            $tipoPago->pivot->monto = $total;
			dd($tipoPago->pivot);
            $tipoPago->pivot->save();
        }
		
    }

    public function totalTipoPago($id)
    {

        $tipoPago = $this->tipoPagos()->where('id','=',$id)->first();

        $pagosEfectivo = new Collection();
        $total = $tipoPago->pivot->monto;

        $pagosEfectivo = $pagosEfectivo->merge($this->pagosPorTipo($tipoPago->id, $this->cerrado_at));
		$pagosEfectivo = $pagosEfectivo->merge($this->movimientosPorTipo($tipoPago->id, $this->cerrado_at));

        foreach($pagosEfectivo as $pago) {
            $total += $pago->precio;
        }
        return $total;
	}
 

    public function totalEfectivo()
    {

        $tipoPago = $this->tipoPagos()->where('name','=','Efectivo')->first();

        $total = $this->totalTipoPago($tipoPago->id);
 
        return $total;
    }

    public function totalNoEfectivo()
    {
        $tipoPagos = $this->tipoPagos()->where('name','!=','Efectivo')->get();

        $total = 0;

        foreach($tipoPagos as $tipoPago) {
            $total += $this->totalTipoPago($tipoPago->id);
        }

        return $total;

    }

    public function abrir($id) {
        $this->cerrado = 0;

        $this->user_id = $id; 

        $this->save();

    }
    
    public function cerrar($id) {
        $this->cerrado = 1;

        $this->actualizarMontos();

        $this->user_id = null;

        $cierre = new Cierre([
            'at' => Carbon::now(),
            'cerrador_id' => $id,
            'caja_id' => $this->id,
            'efectivo' => $this->efectivo,
            'noEfectivo' => $this->noEfectivo
        ]);

        $this->cerrado_at = Carbon::now();

        $this->save();
        $cierre->save();
    }
	/**
     * Accessors
     **/
    public function getUserAttribute()
    {

        if (! $this->relationLoaded('user')) {
            $this->load('user');
        }

        return $this->getRelation('user') ?: $this->defaultUser();
    }

    public function getCerradoAttribute($value)
    {
        return ($value == 1) ? 'Cerrado' : 'Abierto';
    }

    public function getEfectivoAttribute() 
    {
        return $this->totalEfectivo();
    }

    public function getNoEfectivoAttribute() 
    {
        return $this->totalNoEfectivo();
    }
    /**
     * Relationships
     *
     */
    
	/**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(User::class);
    }

	/**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

	/**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }

	/**
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany
     */
    public function tipoPagos()
    {
        return $this->morphedByMany('App\Models\TipoPago', 'cajeable')->withPivot('monto');
    }
    
}
