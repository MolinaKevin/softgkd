<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TipoPago
 * @package App\Models
 * @version July 23, 2022, 7:29 am -03
 *
 * @property string name
 */
class TipoPago extends Model
{
    use SoftDeletes;

    public $table = 'tipo_pagos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
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
     * Relationships
     */

	/**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function metodoPagos()
    {
        return $this->hasMany(MetodoPago::class);
    }

	/**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     **/
    public function cajas()
    {
        return $this->morphToMany('App\Models\Caja', 'cajeable');
    }

	/**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     **/
    public function pagos()
    {
        return $this->hasManyThrough(Pago::class, MetodoPago::class);
    }
}
