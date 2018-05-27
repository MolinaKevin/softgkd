<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Huella
 * @package App\Models
 * @version May 27, 2018, 11:23 am -03
 *
 * @property string codigo
 * @property integer user_id
 */
class Huella extends Model
{
    use SoftDeletes;

    public $table = 'huellas';
    

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

    /**
     * Relations
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
