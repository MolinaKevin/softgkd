<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\MetodoPago;

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

        $pagos  = $this->tipoPagos()->where('name','=','Efectivo')->first()->pagos;

        $pagosEfectivo = $pagos->whereHas('caja', function($query)
        {
                $query->where('caja_id', '=', $this->id);

        })->get();
        dd($pagosEfectivo);
        return $pagos;
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

    public function getEfectivoAttribute() {
        return $this->totalEfectivo();
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
        return $this->morphedByMany('App\Models\TipoPago', 'cajeable');
    }
    
}
