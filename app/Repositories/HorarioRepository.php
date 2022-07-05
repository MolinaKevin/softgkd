<?php

namespace App\Repositories;

use App\Models\Horario;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class HorarioRepository
 * @package App\Repositories
 * @version February 11, 2018, 10:59 pm UTC
 *
 * @method Horario findWithoutFail($id, $columns = ['*'])
 * @method Horario find($id, $columns = ['*'])
 * @method Horario first($columns = ['*'])
*/
class HorarioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'dia',
        'hora'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Horario::class;
    }
}
