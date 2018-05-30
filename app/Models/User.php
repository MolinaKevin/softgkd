<?php

namespace App\Models;

use App\Models\{
    Familia, Revisacion, Plan
};
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

/**
 * Class User
 *
 * @package App\Models
 * @version December 19, 2017, 5:51 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection familiaPlan
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

    public $table = 'users';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected $appends = ['name'];

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
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
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
        'descuento' => 'float'
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
    ];


    /**
     * Methods
     **/
    public function defaultFamilia()
    {
        $familia = new Familia([
            'name' => 'Staff',
        ]);

        return $familia;
    }

    public function hasDeuda(){

        return (bool) $this->familia->deudas()->first();
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

    public function getNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getPagadoAttribute($value)
    {
        return ($this->pivot->pagado == 0) ? false : true;
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function deudas()
    {
        return $this->hasMany(Revisacion::class);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function huellas()
    {
        return $this->hasMany(Huella::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function plans()
    {
        return $this->belongsToMany(Plan::class)->withPivot('id','vencimiento', 'clases', 'pagado')->using('App\Models\PlanUser');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }
}
