<?php

namespace App\Models;

use App\Traits\CanBeAdeudar;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PlanUser
 *
 * @package App\Models
 * @version February 9, 2018, 11:04 pm UTC
 *
 * @property \App\Models\Plan plan
 * @property \App\Models\User user
 * @property \Illuminate\Database\Eloquent\Collection revisacions
 * @property \Illuminate\Database\Eloquent\Collection roleUser
 * @property string|\Carbon\Carbon vencimiento
 * @property integer clases
 * @property boolean pagado
 * @property integer plan_id
 * @property integer user_id
 */
class PlanUser extends Pivot
{
    use SoftDeletes;
    use CanBeAdeudar;

    public $table = 'plan_user';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'vencimiento',
        'clases',
        'pagado',
        'plan_id',
        'user_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'clases' => 'integer',
        'pagado' => 'boolean',
        'plan_id' => 'integer',
        'user_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    /**
     * Accessors
     **/

    public function getPrecioAttribute($value)
    {
        return $this->plan->precio;
    }

    public function getNameAttribute($value)
    {
        return $this->plan->name;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
