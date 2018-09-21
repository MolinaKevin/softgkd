<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tag
 * @package App\Models
 * @version September 12, 2018, 12:42 pm -03
 *
 * @property string codigo
 * @property integer user_id
 */
class Tag extends Model
{
    use SoftDeletes;

    public $table = 'tags';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'codigo',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'codigo' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'codigo' => 'required',
        'user_id' => 'required'
    ];


    
}
