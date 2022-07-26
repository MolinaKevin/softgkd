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
        'cerrado'
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

    public function totalEfectivo()
    {

        $tipoPago = $this->tipoPagos()->where('name','=','Efectivo')->first();

        $pagosEfectivo = new Collection();
        $total = $tipoPago->pivot->monto;

        $pagosEfectivo = $pagosEfectivo->merge($this->pagos()->where('updated_at','>=',$this->cerrado_at)->whereHas('metodoPago', function($query) use($tipoPago){$query->where('tipo_pago_id',$tipoPago->id);})->get());

        foreach($pagosEfectivo as $pago) {
            $total += $pago->precio;
        }
        return $total;
    }

    public function totalNoEfectivo()
    {

        $tipoPagos = $this->tipoPagos()->where('name','!=','Efectivo')->get();

        $pagosNoEfectivo = new Collection();
        $total = 0;

        foreach($tipoPagos as $tipoPago) {
            $total += $tipoPago->pivot->monto;
            $pagosNoEfectivo = $pagosNoEfectivo->merge($this->pagos()->where('updated_at','>=',$this->cerrado_at)->whereHas('metodoPago', function($query) use($tipoPago){$query->where('tipo_pago_id',$tipoPago->id);})->get());
        }

        foreach($pagosNoEfectivo as $pago) {
            $total += $pago->precio;
        }
        return $total;

    }

    public function abrir() {
        $this->cerrado = 0;

        $this->user()->associate(Auth::user());

        $this->save();

    }
    
    public function cerrar() {
        $this->cerrado = 1;

        $this->cerrado_at = Carbon::now();

        $cierre = new Cierre([
            at => Carbon::now(),
            cerrador_id => Auth::user()->id,
            caja_id => $this->id
        ]);

        $cierre->save();
        $this->save();
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
