<?php

namespace App\Repositories;

use App\Models\Asistencia;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AsistenciaRepository
 * @package App\Repositories
 * @version May 19, 2018, 5:28 pm UTC
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
        'horario'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Asistencia::class;
    }
}
