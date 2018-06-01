<?php

namespace App\Models;

use App\Models\{
    Deuda, User, Pago
};
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Familia
 *
 * @package App\Models
 * @version December 16, 2017, 6:36 am UTC
 *
 * @property string name
 */
class Familia extends Model
{
    use SoftDeletes;

    public $table = 'familias';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     **/
    public function deudas()
    {
        return $this->morphMany(Deuda::class,'adeudable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
}
