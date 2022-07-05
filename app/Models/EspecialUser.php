<?php

namespace App\Models;

use App\Models\Especial;
use App\Models\User;
use App\Traits\CanBeAdeudar;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class EspecialUser
 * @package App\Models
 * @version June 1, 2018, 6:14 pm -03
 *
 * @property \App\Models\Especial especial
 * @property \App\Models\User user
 * @property \Illuminate\Database\Eloquent\Collection horarioPlan
 * @property \Illuminate\Database\Eloquent\Collection planUser
 * @property \Illuminate\Database\Eloquent\Collection revisacions
 * @property \Illuminate\Database\Eloquent\Collection roleUser
 * @property string|\Carbon\Carbon vencimiento
 * @property integer clases
 * @property boolean pagado
 * @property integer especial_id
 * @property integer user_id
 */
class EspecialUser extends Pivot
{
    use SoftDeletes;
    use CanBeAdeudar;

    public $table = 'especial_user';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'vencimiento',
        'clases',
        'pagado',
        'especial_id',
        'user_id'
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
        'especial_id' => 'integer',
        'user_id' => 'integer'
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
        return ($this->especial->date > 0);
    }

    public function isVencido()
    {
        return ($this->vencimiento < Carbon::now());
    }

    public function renovar()
    {
        $this->vencimiento = Carbon::parse($this->vencimiento)->addDays($this->especial->cantidad)->startOfDay();

        return $this->update();
    }

    /**
     * Accessors
     **/

    public function getPrecioAttribute()
    {
        $precio = $this->especial->precio - ($this->especial->precio * $this->user->descuento / 100);

        return $precio;
    }

    public function getNameAttribute()
    {
        return $this->especial->name;
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
    public function especial()
    {
        return $this->belongsTo(Especial::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
