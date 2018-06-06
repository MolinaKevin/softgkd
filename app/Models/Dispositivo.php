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
     * Get all of the planes that are assigned this ingresable.
     */
    public function plans()
    {
        return $this->morphedByMany('App\Models\Plan', 'ingresable');
    }

    /**
     * Get all of the planes especiales that are assigned this ingresable.
     */
    public function especials()
    {
        return $this->morphedByMany('App\Models\Especial', 'ingresable');
    }

}
