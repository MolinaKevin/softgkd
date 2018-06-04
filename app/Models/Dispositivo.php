<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Dispositivo
 * @package App\Models
 * @version June 3, 2018, 8:04 pm -03
 *
 * @property string name
 * @property string ip
 * @property string puerto
 */
class Dispositivo extends Model
{
    use SoftDeletes;

    public $table = 'dispositivos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'ip',
        'puerto'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'ip' => 'string',
        'puerto' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'ip' => 'required',
        'puerto' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     **/
    public function ingresable()
    {
        return $this->morphTo();
    }
}
