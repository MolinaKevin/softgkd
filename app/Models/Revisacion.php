<?php

namespace App\Models;

use Carbon\Carbon;
use DebugBar\DebugBar;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Revisacion
 *
 * @package App\Models
 * @version December 16, 2017, 7:08 am UTC
 *
 * @property mediumText descripcion
 * @property boolean aprobado
 * @property dateTime finalizacion
 * @property integer medico_id
 * @property integer user_id
 */
class Revisacion extends Model
{
    use SoftDeletes;

    public $table = 'revisacions';

    protected $dates = ['deleted_at'];

    protected $appends = ['is_vencida'];

    public $fillable = [
        'descripcion',
        'aprobado',
        'finalizacion',
        'medico_id',
        'user_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'aprobado' => 'boolean',
        'finalizacion' => 'datetime',
        'medico_id' => 'integer',
        'user_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'aprobado' => 'required',
        'finalizacion' => 'required_if:aprobado,==,1',
        'medico' => 'required',
        'user' => 'required',
    ];

    /**
     * Methods
     */

    public function isVencida(){
        return $this->finalizacion <= Carbon::now() && (bool) $this->aprobado;
    }

    public function getAprobadoTextoAttribute(){
        if ($this->aprobado) {
            return "Aprobado";
        }
        return "Rechazado";
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function medico()
    {
        return $this->belongsTo(User::class, 'medico_id');
    }
}
