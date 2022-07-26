<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Cierre
 * @package App\Models
 * @version July 26, 2022, 6:45 am -03
 *
 * @property string at
 */
class Cierre extends Model
{
    use SoftDeletes;

    public $table = 'cierres';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'at',
        'cerrador_id',
        'caja_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'at' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'at' => 'required'
    ];

    /**
     * Relationships
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class,'cerrador_id');
    }

    
}
