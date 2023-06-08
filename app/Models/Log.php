<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Log
 * @package App\Models
 * @version November 20, 2022, 1:01 pm -03
 *
 * @property string message
 */
class Log extends Model
{
    use SoftDeletes;

    public $table = 'logs';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'message'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'message' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
