<?php

namespace App\Repositories;

use App\Models\Revisacion;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class RevisacionRepository
 * @package App\Repositories
 * @version December 16, 2017, 7:08 am UTC
 *
 * @method Revisacion findWithoutFail($id, $columns = ['*'])
 * @method Revisacion find($id, $columns = ['*'])
 * @method Revisacion first($columns = ['*'])
*/
class RevisacionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'descripcion',
        'aprobado',
        'finalizacion',
        'medico_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Revisacion::class;
    }
}
