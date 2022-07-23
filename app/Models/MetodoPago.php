<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MetodoPago
 * @package App\Models
 * @version July 5, 2022, 2:51 pm -03
 *
 * @property string title
 * @property boolean cash
 */
class MetodoPago extends Model
{
    use SoftDeletes;

    public $table = 'metodo_pagos';
    
    protected $dates = ['deleted_at'];

    public $fillable = [
        'title',
        'tipoPago',
        'cash'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'tipoPago' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        //'title' => 'required|unique:title'
        'title' => 'required'
    ];

    /**
     * Relationships
     *
     * @var array
     */

	/**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tipoPago()
    {
        return $this->belongsTo(TipoPago::class);
    }
    
}
