<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Arqueo
 * @package App\Models
 * @version February 6, 2019, 4:31 pm -03
 *
 * @property double total
 */
class Arqueo extends Model
{
    use SoftDeletes;

    public $table = 'arqueos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'total'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'total' => 'double'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'total' => 'required|numeric'
    ];

    
}
