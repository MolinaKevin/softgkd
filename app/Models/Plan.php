<?php

namespace App\Models;

use App\Models\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Plan
 * @package App\Models
 * @version January 6, 2018, 4:54 pm UTC
 *
 * @property string name
 * @property float precio
 * @property integer cantidad
 * @property boolean date
 * @property integer porDia
 * @property boolean limite
 */
class Plan extends Model
{
    use SoftDeletes;

    public $table = 'plans';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


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
        'id' => 'integer',
        'name' => 'string',
        'precio' => 'float',
        'cantidad' => 'integer',
        'date' => 'boolean',
        'porDia' => 'integer',
        'limite' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getDateAttribute($value)
    {
        return ($value == 1) ? 'Días' : 'Clases';
    }

    public function getLimiteAttribute($value)
    {
        return ($value == 1) ? 'Activado' : 'Desactivado';
    }
}
