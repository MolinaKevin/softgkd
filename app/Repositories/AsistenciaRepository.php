<?php

namespace App\Repositories;

use App\Models\Asistencia;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AsistenciaRepository
 * @package App\Repositories
 * @version June 10, 2018, 11:50 pm -03
 *
 * @method Asistencia findWithoutFail($id, $columns = ['*'])
 * @method Asistencia find($id, $columns = ['*'])
 * @method Asistencia first($columns = ['*'])
*/
class AsistenciaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'horario',
        'user_id',
        'actividad'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Asistencia::class;
    }
}
