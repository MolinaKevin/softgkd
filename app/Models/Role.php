<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Role
 *
 * @package App\Models
 * @version January 2, 2018, 3:38 pm UTC
 *
 * @property string name
 * @property string display_name
 * @property string descripcion
 * @property boolean estado
 */
class Role extends Model
{
    use SoftDeletes;

    public $table = 'roles';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'display_name',
        'descripcion',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'display_name' => 'string',
        'descripcion' => 'string',
        'estado' => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|min:4',
        'estado' => 'required',
    ];

    /**
     * Many-to-Many relations with User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
