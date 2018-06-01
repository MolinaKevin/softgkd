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
 * @property integet cantidad
 * @property tinyInteger date
 * @property integer porDia
 * @property boolean limite
 */
class Especial extends Model
{
    use SoftDeletes;

    public $table = 'especials';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'precio',
        'cantidad',
        'date',
        'porDia',
        'limite'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'precio' => 'double',
        'porDia' => 'integer',
        'limite' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'precio' => 'required numeric',
        'cantidad' => 'required|numeric',
        'date' => 'required',
        'porDia' => 'required',
        'limite' => 'required'
    ];

    
}
