<?php

namespace App\Models;

use App\Models\{Familia, Revisacion, Plan};
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

/**
 * Class User
 * @package App\Models
 * @version December 19, 2017, 5:51 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection familiaPlan
 * @property \Illuminate\Database\Eloquent\Collection Familia
 * @property \Illuminate\Database\Eloquent\Collection Revisacion
 * @property string name
 * @property string email
 * @property string password
 * @property string remember_token
 */
class User extends Model
{
    use SoftDeletes;

    public $table = 'users';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'email',
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'remember_token' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
    /**
     * Setters
     **/
    public function setPasswordAttribute($password){
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function familia()
    {
        return $this->belongsTo(Familia::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function revisacions()
    {
        return $this->hasMany(Revisacion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }
}
