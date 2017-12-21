<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Plan
 * @package App\Models
 * @version December 16, 2017, 6:39 am UTC
 *
 * @property string name
 * @property double precio
 */
class Plan extends Model
{
    use SoftDeletes;

    public $table = 'plans';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'precio'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'precio' => 'double'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|min:4',
        'precio' => 'required'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
