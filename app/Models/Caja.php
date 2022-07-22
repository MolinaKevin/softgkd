<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

/**
 * Class Caja
 * @package App\Models
 * @version July 21, 2022, 11:20 am -03
 *
 * @property string name
 * @property boolean cerrado
 */
class Caja extends Model
{
    use SoftDeletes;

    public $table = 'cajas';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'cerrado'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'cerrado' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

	/**
     * Methods
     **/
    public function defaultUser()
    {
        $user = new User([
            'name' => 'No abierto',
        ]);

        return $user;
    }

	/**
     * Accessors
     **/
    public function getUserAttribute()
    {

        if (! $this->relationLoaded('user')) {
            $this->load('user');
        }
        dd($this->relationLoaded('user');

        return $this->getRelation('user') ?: $this->defaultUser();
    }

    /**
     * Relationships
     *
     */
    
	/**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
