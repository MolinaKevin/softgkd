<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\CanBeAdeudar;

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
     * Methods
     **/

    public function vencePorFecha()
    {
        return ($this->plan->date > 0);
    }

    public function isVencido()
    {
        return ($this->vencimiento < Carbon::now());
    }

    public function renovar()
    {
        switch ($this->plan->date) {
            case 0:
                $this->vencimiento = Carbon::now()->addDays($this->plan->cantidad)->startOfDay();
                break;
            case 1:
                $this->vencimiento = Carbon::now()->addDays($this->plan->cantidad)->startOfDay();
                break;
            case 2:
                $this->vencimiento = Carbon::now()->addWeek()->startOfDay();
                break;
            case 3:
                $this->vencimiento = Carbon::now()->addMonth()->startOfDay();
                break;
            case 4:
                $this->vencimiento = Carbon::now()->addYear()->startOfDay();
                break;
            default:
                $this->vencimiento = Carbon::now()->addDays($this->plan->cantidad)->startOfDay();
                break;
        }

        return $this->update();
    }

    /**
     * Accessors
     **/

    public function getPrecioAttribute()
    {
        $precio = $this->plan->precio;
        $descuento = $this->user->descuento;
        $result = $precio - ($precio * $descuento / 100);

        return $result;
    }

    public function getNameAttribute()
    {
        return $this->plan->name;
    }

    public function getCreatedAtColumn()
    {
        return 'created_at';
    }

    public function getUpdatedAtColumn()
    {
        return 'updated_at';
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\morphOne
     **/
    public function deuda()
    {
        return $this->morphOne(Deuda::class, 'deudable');
    }

}
